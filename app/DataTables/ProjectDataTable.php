<?php

namespace App\DataTables;

use App\Models\Project;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Storage;

class ProjectDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($project) {
                $words = explode(' ', $project->name);
                $initials = '';
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                    if (strlen($initials) >= 2) break;
                }

                return '
                    <div class="flex items-center">
                        <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-white manrope-semibold rounded-[6px] py-[10px] px-[10px]">' . $initials . '</span>
                        <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer">
                            ' . $project->name . '
                        </div>
                    </div>';
            })
            ->addColumn('status', function ($project) {
                $status = $project->is_active ? 'Active' : 'Inactive';
                $color = $project->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$project->id}\" onclick=\"toggleProjectStatus({$project->id})\">{$status}</button>";
            })
            ->editColumn('company_name', function ($project) {
                return $project->company_name ?? 'N/A';
            })
            ->addColumn('action', function ($project) {
                return '
                    <div class="flex justify-start relative">
                        <span>
                            <a href="javascript:void(0);" onclick="showEditModal(' . $project->id . ')"><img src="' . asset('admin-theme/assets/images/edit-report.png') . '" class="w-[21px] mr-[20px]"></a>
                        </span>
                        <span>
                            <a href="crane.html"><img src="' . asset('admin-theme/assets/images/live.png') . '" class="w-[23px] mr-[20px]"></a>
                        </span>
                        <span class="mt-[8px]">
                            <a href="javascript:void(0);"><img src="' . asset('admin-theme/assets/images/table-menu.png') . '" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a>
                        </span>
                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                            <ul>
                                <li class="py-[5px]">
                                    <a href="javascript:void(0);" class="flex manrope-medium text-[#344563] text-[15px]">
                                        <img src="' . asset('admin-theme/assets/images/equipment.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="toggleModal(\'createEquipmentModal\')">Add Equipment</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="javascript:void(0);" class="flex text-[#344563] text-[16px] manrope-medium">
                                        <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="openCreateUserModal(' . $project->company->id . ',' . $project->id . ')">Add People</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="javascript:void(0);" class="flex manrope-medium text-[#344563] text-[15px]">
                                        <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p onclick="toggleModal(\'createTrackableModal\', ' . $project->id . ')">Add Trackable</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <a href="' . route('projects.show', $project->id) . '" class="flex manrope-medium text-[#344563] text-[15px]">
                                        <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p>Trackables</p>
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
            ->editColumn('created_at', function ($project) {
                return $project->created_at->format('M d - Y');
            })
            ->filterColumn('company_name', function($query, $keyword) {
                $query->where('companies.company_name', 'like', "%{$keyword}%");
            })
            ->orderColumn('status', 'is_active $1')
            ->rawColumns(['name', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        $query = $model->newQuery()
            ->leftJoin('companies', 'projects.company_id', '=', 'companies.id')
            ->select([
                'projects.*',
                'companies.company_name as company_name',
            ]);

        // Apply company filter
        if (request()->has('company_ids') && !empty(request()->input('company_ids'))) {
            $query->whereIn('company_id', request()->input('company_ids'));
        }

        // Apply location filter
        if (request()->has('plants') && !empty(request()->input('plants'))) {
            $query->whereIn('plant_name', request()->input('plants'));
        }

        // Apply status filter
        if (request()->has('statuses') && !empty(request()->input('statuses'))) {
            $query->whereIn('projects.is_active', array_map(function ($status) {
                return $status == 'Active' ? 1 : ($status == 'Inactive' ? 0 : ($status == 'Blocked' ? 2 : $status));
            }, request()->input('statuses')));
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('projects-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['csv', 'excel', 'pdf', 'print'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => ['title' => 'Project Name', 'className' => 'text-left text-[#3D3D3D] text-[15px] manrope-regular',],
            'company_name' => ['title' => 'Company', 'className' => 'text-left text-[#3D3D3D] text-[15px] manrope-regular'],
            'status' => ['title' => 'Status', 'className' => 'text-left text-[#3D3D3D] text-[15px] manrope-regular'],
            'created_at' => ['title' => 'Created At', 'className' => 'text-left text-[#3D3D3D] text-[15px] manrope-regular'],
            'action' => ['title' => 'Action', 'orderable' => false, 'searchable' => false, 'className' => 'text-left text-[#3D3D3D] text-[15px] manrope-regular'],
        ];
    }

    protected function filename(): string
    {
        return 'Project_' . date('YmdHis');
    }
}
