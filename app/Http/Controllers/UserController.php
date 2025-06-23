<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('users.index', [
            'companies' => Company::pluck('company_name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'users' => User::pluck('name', 'id')->toArray(),
            'user_counts' => User::count(),
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'statuses' => [
                1 => 'Active',
                0 => 'Inactive'
            ]
        ]);
    }

    public function data(UserDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::pluck('company_name', 'id')->toArray();
        $projects = Project::pluck('name', 'id')->toArray();
        return view('users.add', compact('companies', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // dd($request);
        Log::info("request", $request->all());
        $data = $request->validated();

        // Handle image upload if present
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 's3');
        }

        // Create new user
        $user = User::create([
            'name' => $data['user_name'],
            'email' => $data['email'] ?? null,
            'password' => bcrypt(Str::random(10)),
            'company_id' => $data['company_id'],
            'project_id' => $data['project_id'],
            'location' => $data['location'],
            'access_level' => $data['access_level'],
            'profile_img' => $imagePath,
            'is_active' => 1,
        ]);

        // Assign default "user" role
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }

        // ✅ Assign permission from access_level
        if (!empty($data['access_level'])) {
            $permission = Permission::where('id', $data['access_level'])->first();
            if ($permission) {
                $user->givePermissionTo($permission);
            }
        }

        $user->projects()->sync($request->projects);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $companies = Company::pluck('company_name', 'id')->toArray();
        $projects = $user->projects()->get(); // Fetch projects via pivot table
        $companies = $user->companies()->get();
        $projectNames = $projects->pluck('name')->join(', '); // Comma-separated project names
        $companyNames = $companies->pluck('company_name')->join(', '); 
        return view('users.show', compact('user', 'companies', 'projects', 'projectNames', 'companyNames'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (request()->ajax()) {
            return response()->json([
                'id' => $user->id,
                'user_name' => $user->name,
                'email' => $user->email,
                'company_id' => $user->company_id,
                'project_id' => $user->project_id,
                'location' => $user->location,
                'access_level' => $user->access_level,
                'profile_img' => $user->profile_img ? Storage::disk('s3')->url($user->image) : null,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            if ($user->profile_img) {
                Storage::disk('s3')->delete($user->profile_img);
            }
            $data['image'] = $request->file('image')->store('user_images', 's3');
        } else {
            $data['image'] = $user->profile_img;
        }

        // Update user
        $user->update([
            'name' => $data['user_name'],
            'email' => $data['email'] ?? null,
            'company_id' => $data['company_id'],
            'project_id' => $data['project_id'],
            'location' => $data['location'],
            'access_level' => $data['access_level'],
            'profile_img' => $data['image'],
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->profile_img) {
            Storage::disk('s3')->delete($user->profile_img);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle the active status of a user.
     */
    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User status updated successfully',
            'is_active' => $user->is_active
        ]);
    }
}
