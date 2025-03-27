<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('companies.index');
    }

    public function data(Request $request)
    {
        $companies = Company::all();

        return DataTables::of($companies)
            ->addColumn('initials', function ($company) {
                // Extract the first letters of the company name for initials
                $words = explode(' ', $company->company_name);
                $initials = '';
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                    if (strlen($initials) >= 2) break;
                }
                return $initials;
            })
            ->addColumn('status', function ($company) {
                // For now, we'll assume all companies are active; you can modify this based on your logic
                return '<button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">Active</button>';
            })
            ->addColumn('people', function ($company) {
                // This is a placeholder; you can fetch actual people data if available
                return '
                    <div class="people-profile flex justify-center">
                        <img src="' . asset('admin-theme/assets/images/people-1.png') . '" class="w-[30px] h-[30px] object-contain">
                        <img src="' . asset('admin-theme/assets/images/people-2.png') . '" class="ml-[-10px]">
                        <img src="' . asset('admin-theme/assets/images/people-3.png') . '" class="ml-[-10px]">
                        <img src="' . asset('admin-theme/assets/images/people-4.png') . '" class="ml-[-10px]">
                        <span class="bg-[#437651] text-white w-[30px] h-[30px] rounded-[20px] p-[5px] manrope-medium">2+</span>
                    </div>';
            })
            ->addColumn('action', function ($company) {
                return '
                    <div class="flex justify-center relative">
                        <span>
                            <a href="#"><img src="' . asset('admin-theme/assets/images/edit-report.png') . '" class="w-[21px] mr-[20px]" onclick="toggleModal(\'createCompanyModal\')"></a>
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
                                    <a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/project.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="toggleModalp()">Add Project</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p>Add People</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                <form action="' . route('companies.destroy', $company->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this company?\');">
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
            $data['logo'] = $request->file('logo')->store('logos', 'public');
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
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $company->logo);
            $data['logo'] = $request->file('logo')->store('logos', 'public');
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
}
