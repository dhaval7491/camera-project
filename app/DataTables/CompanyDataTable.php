<?php

namespace App\DataTables;

use App\Models\Company;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('company_name', function ($company) {
                $words = explode(' ', $company->company_name);
                $initials = '';
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                    if (strlen($initials) >= 2) break;
                }
            
                return '
                    <div class="flex items-center">
                        <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-[#004040] text-white manrope-semibold rounded-[6px] py-[10px] px-[10px]">' . $initials . '</span>
                        <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer">
                            ' . $company->company_name . '
                        </div>
                    </div>';
            })
            ->addColumn('status', function ($company) {
                $status = $company->is_active ? 'Active' : 'Inactive';
                $color = $company->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$company->id}\" onclick=\"toggleCompanyStatus({$company->id})\">{$status}</button>";
            })
            ->addColumn('people', function ($company) {
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
                            <a href="javascript:void(0);" onclick="showEditModal(' . $company->id . ')"><img src="' . asset('admin-theme/assets/images/edit-report.png') . '" class="w-[21px] mr-[20px]"></a>
                        </span>
                        <span>
                            <a href="crane.html"><img src="' . asset('admin-theme/assets/images/live.png') . '" class="w-[23px] mr-[20px]"></a>
                        </span>
                        <span class="mt-[8px]">
                            <a href="#"><img src="' . asset('admin-theme/assets/images/table-menu.png') . '" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event, this)"></a>
                        </span>
                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                            <ul>
                                <li class="py-[5px]">
                                    <a href="javascript:void(0);" class="flex text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/project.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="openCreateProjectModal(' . $company->id . ')">Add Project</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="javascript:void(0);" class="flex text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="openCreateUserModal(' . $company->id . ')">Add People</p>
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
            ->rawColumns(['company_name','status', 'people', 'action']);
    }

    public function query(Company $model)
    {
        $query = $model->newQuery();

        // Apply company filter
        if (request()->has('company_ids') && !empty(request()->input('company_ids'))) {
            $query->whereIn('id', request()->input('company_ids'));
        }

        // Apply people filter (assuming a relationship exists between Company and User)
        if (request()->has('people_ids') && !empty(request()->input('people_ids'))) {
            $query->whereHas('admin', function ($q) {
                $q->whereIn('users.id', request()->input('people_ids'));
            });
        }

        // Apply location filter
        if (request()->has('locations') && !empty(request()->input('locations'))) {
            $query->whereIn('location', request()->input('locations'));
        }

        // Apply status filter
        if (request()->has('statuses') && !empty(request()->input('statuses'))) {
            $query->whereIn('is_active', array_map(function($status) {
                return $status == 'Active' ? 1 : 0;
            }, request()->input('statuses')));
        }

        return $query;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('companies-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('company_name')->title('Company Name')->addClass('text-left color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('created_at')->title('Date Created')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('location')->title('Location')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::make('people')->title('People')->addClass('text-center'),
            Column::make('action')->title('Action')->addClass('text-center')->orderable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Company_' . date('YmdHis');
    }
}