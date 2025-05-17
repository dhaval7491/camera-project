<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\DataTables\CompanyDataTable;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Project;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CompanyDataTable $dataTable)
    {
        
        return $dataTable->render('companies.index', [
            'companies' => Company::pluck('company_name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'locations' => Company::distinct()->pluck('location')->toArray(),
            'people' => User::pluck('name', 'id')->toArray(),
            'statuses' => [
                1 => 'Active',
                0 => 'Inactive'
            ]
        ]);
    }

    public function data(CompanyDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $admin = User::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => bcrypt($data['admin_password']),
        ]);

        $superadmin_role = Role::where('name', 'superadmin')->first();
        if ($superadmin_role) {
            $admin->assignRole($superadmin_role);
        }

        if ($request->hasFile('logo')) {
            // $data['logo'] = $request->file('logo')->store('logos', 'public');
            $file = $request->file('logo');
            $path = $file->store('logos', 's3');
            $data['logo'] = $path;
        }

        $company = Company::create([
            'company_name' => $data['company_name'],
            'logo' => $data['logo'] ?? null,
            'location' => $data['location'],
            'admin_id' => $admin->id,
        ]);

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company->load('admin')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        // Return JSON for AJAX requests, otherwise return view
        if (request()->ajax()) {
            return response()->json([
                'id' => $company->id,
                'company_name' => $company->company_name,
                'location' => $company->location,
                'logo' => Storage::disk('s3')->url($company->logo),
            ]);
        }
        // return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest  $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $company->logo);
            $data['logo'] = $request->file('logo')->store('logos', 's3');
        }

        $company->update($data);
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        Storage::delete('public/' . $company->logo);
        $company->delete();
        return redirect()->route('companies.index');
    }

    /**
     * Toggle the active status of a company
     */
    public function toggleActive(Company $company)
    {
        $company->is_active = !$company->is_active;
        $company->save();

        return response()->json([
            'success' => true,
            'message' => 'Company status updated successfully',
            'is_active' => $company->is_active
        ]);
    }
}
