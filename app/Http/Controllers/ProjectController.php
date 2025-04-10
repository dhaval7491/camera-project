<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all()->pluck('company_name', 'id')->toArray();
        return view('projects.index', compact('companies'));
    }

    public function data(Request $request)
    {
        $projects = Project::all();

        return DataTables::of($projects)
            ->addColumn('initials', function ($project) {
                // Extract the first letters of the company name for initials
                $words = explode(' ', $project->name);
                $initials = '';
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                    if (strlen($initials) >= 2) break;
                }
                return $initials;
            })
            ->addColumn('status', function ($project) {
                $status = $project->is_active ? 'Active' : 'Inactive';
                $color = $project->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$project->id}\" onclick=\"toggleProjectStatus({$project->id})\">{$status}</button>";
            })
            ->addColumn('company_name', function ($project) {
                // This is a placeholder; you can fetch actual people data if available
                return $project->company->company_name;
            })
            ->addColumn('action', function ($project) {
                return '
                    <div class="flex justify-center relative">
                        <span>
                            <a href="#" onclick="showEditModal(' . $project->id . ')"><img src="' . asset('admin-theme/assets/images/edit-report.png') . '" class="w-[21px] mr-[20px]"></a>
                        </span>
                        <span>
                            <a href="crane.html"><img src="' . asset('admin-theme/assets/images/live.png') . '" class="w-[23px] mr-[20px]"></a>
                        </span>
                        <span class="mt-[8px]">
                            <a href="#"><img src="' . asset('admin-theme/assets/images/table-menu.png') . '" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a>
                        </span>
                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                            <ul>
                                <li class="py-[5px]">
                                    <a href="#" class="flex manrope-medium text-[#344563] text-[15px]">
                                        <img src="' . asset('admin-theme/assets/images/equipment.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="toggleModale()">Add Equipment</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p>Add People</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="#" class="flex manrope-medium text-[#344563] text-[15px]">
                                        <img src="'.asset('admin-theme/assets/images/add-people.png').'" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="toggleModalcont()">Add Trackable</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                <form action="' . route('projects.destroy', $project->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this project?\');">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="flex items-center text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p>Delete</p>
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>
                    </div>';
            })
            ->editColumn('created_at', function ($company) {
                return $company->created_at->format('M d - Y');
            })
            ->rawColumns(['status', 'people', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        Project::create($validated);
        return response()->json(['success' => 'Project created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, string $id)
    {
        $validated = $request->validated();
        $project = Project::findOrFail($id);
        $project->update($validated);
        return response()->json(['success' => 'Project updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['success' => 'Project deleted successfully']);
    }

    /**
     * Toggle the active status of a project
     */
    public function toggleActive(Project $project)
    {
        $project->is_active = !$project->is_active;
        $project->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Project status updated successfully',
            'is_active' => $project->is_active
        ]);
    }
}
