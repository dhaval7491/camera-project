<?php

namespace App\DataTables;

use App\Models\Project;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class ProjectDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->filter(function ($query) {
                if ($keyword = request('search')['value']) {
                    $keyword = strtolower($keyword);

                    $query->where(function ($q) use ($keyword) {
                        $q->whereRaw('LOWER(projects.name) LIKE ?', ["%{$keyword}%"])
                            ->orWhereRaw('CAST(projects.is_active AS CHAR) LIKE ?', ["%{$keyword}%"])
                            ->orWhereRaw('DATE_FORMAT(projects.created_at, "%Y-%m-%d") LIKE ?', ["%{$keyword}%"])
                            ->orWhereRaw("EXISTS (
                            SELECT 1 FROM company_project cp
                            JOIN companies c ON c.id = cp.company_id
                            WHERE cp.project_id = projects.id
                            AND LOWER(c.company_name) LIKE ?
                        )", ["%{$keyword}%"]);
                    });
                }
            })
            ->editColumn('name', function ($project) {
                $initials = collect(explode(' ', $project->name))
                    ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                    ->implode('');
                $initials = substr($initials, 0, 2);

                return '
                <div class="flex items-center">
                    <span class="inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-white manrope-semibold rounded-[6px] py-[10px] px-[10px] text-center">'
                    . $initials .
                    '</span>
                    <div class="text-[#344563] text-[13px] manrope-regular cursor-pointer">' . $project->name . '</div>
                </div>';
            })
            ->editColumn('is_active', function ($project) {
                $status = $project->is_active ? 'Active' : 'Inactive';
                $color = $project->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-[12px] font-medium cursor-pointer\" data-id=\"{$project->id}\" onclick=\"toggleProjectStatus({$project->id})\">{$status}</button>";
            })
            ->editColumn('company_name', fn($project) => $project->company_name ?? 'N/A')
            ->editColumn('created_at', fn($project) => $project->created_at->format('M d - Y'))
            ->addColumn('action', fn($project) => $this->buildActionColumn($project))
            ->rawColumns(['name', 'is_active', 'action'])
            ->addIndexColumn();
    }

    public function query(Project $model)
    {
        $query = $model->newQuery()
            ->leftJoin('company_project', 'projects.id', '=', 'company_project.project_id')
            ->leftJoin('companies', 'company_project.company_id', '=', 'companies.id')
            ->select([
                'projects.id',
                'projects.name',
                'projects.location',
                'projects.is_active',
                'projects.created_at',
                \DB::raw("(SELECT GROUP_CONCAT(c.company_name SEPARATOR ', ') 
                       FROM company_project cp 
                       JOIN companies c ON c.id = cp.company_id 
                       WHERE cp.project_id = projects.id) as company_name")
            ])
            ->groupBy(
                'projects.id',
                'projects.name',
                'projects.location',
                'projects.is_active',
                'projects.created_at'
            );

        // ✅ Filter by selected companies (from filter dropdown)
        if (request()->has('company_ids') && !empty(request('company_ids'))) {
            $query->whereIn('company_project.company_id', request('company_ids'));
        }

        // ✅ Filter by statuses (e.g., Active, Inactive, Blocked)
        if (request()->has('statuses') && !empty(request('statuses'))) {
            $mappedStatuses = array_map(function ($status) {
                return match (strtolower($status)) {
                    'active' => 1,
                    'inactive' => 0,
                    'blocked' => 2,
                    default => $status
                };
            }, request('statuses'));

            $query->whereIn('projects.is_active', $mappedStatuses);
        }

        // ✅ Global search including company name (safe and optimized)
        if ($keyword = request('search.value')) {
            $keyword = strtolower($keyword);

            $query->where(function ($q) use ($keyword) {
                $q->whereRaw('LOWER(projects.name) LIKE ?', ["%{$keyword}%"])
                    ->orWhereRaw('CAST(projects.is_active AS CHAR) LIKE ?', ["%{$keyword}%"])
                    ->orWhereRaw('DATE_FORMAT(projects.created_at, "%Y-%m-%d") LIKE ?', ["%{$keyword}%"])
                    ->orWhereRaw("EXISTS (
                  SELECT 1 FROM company_project cp
                  JOIN companies c ON c.id = cp.company_id
                  WHERE cp.project_id = projects.id
                  AND LOWER(c.company_name) LIKE ?
              )", ["%{$keyword}%"]);
            });
        }

        return $query;
    }


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
                'searchDelay' => 500,
                'rowCallback' => 'function(row, data, index) {
                   if (index % 2 === 1) {
                        $(row).css("background-color", "#F6F9F7"); // Even rows
                    } else {
                        $(row).css("background-color", "#ffffff"); // Odd rows
                    }
                }',
            ]);
    }

    protected function getColumns()
    {
        return [
            'name' => ['title' => 'Project Name', 'searchable' => true , 'className' => 'text-left text-[#3D3D3D] text-[13px] manrope-regular'],
            'company_name' => ['title' => 'Company', 'searchable' => false , 'className' => 'text-left text-[#3D3D3D] text-[13px] manrope-regular'],
            'is_active' => ['title' => 'Status', 'searchable' => true , 'className' => 'text-left text-[#3D3D3D] text-[13px] manrope-regular'],
            'created_at' => ['title' => 'Created At', 'searchable' => true , 'className' => 'text-left text-[#3D3D3D] text-[13px] manrope-regular'],
            'action' => ['title' => 'Action', 'orderable' => false, 'searchable' => false , 'className' => 'text-left text-[#3D3D3D] text-[13px] manrope-regular'],
        ];
    }

    protected function filename(): string
    {
        return 'Project_' . date('YmdHis');
    }

    protected function buildActionColumn($project)
    {
        return '
            <div class="flex justify-start relative">
                <span><a href="javascript:void(0);" onclick="showEditModal(' . $project->id . ')"><img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="w-[21px] mr-[20px]"></a></span>
                <span class="mt-[8px]"><a href="javascript:void(0);"><img src="' . asset('admin-theme/assets/images/table-menu.png') . '" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                    <ul>
                        <li class="py-[5px]">
                            <a href="javascript:void(0);" class="flex manrope-medium text-[#344563] text-[13px]">
                                <img src="' . asset('admin-theme/assets/images/equipment.png') . '" class="w-[16px] mr-[11px] object-contain">
                                <p onclick="toggleModal(\'createEquipmentModal\')">Add Equipment</p>
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <a href="javascript:void(0);" class="flex text-[#344563] text-[13px] manrope-medium">
                                <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                <p onclick="openCreateUserModal(' . $project->id . ')">Add People</p>
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <a href="' . route('projects.show', $project->id) . '" class="flex manrope-medium text-[#344563] text-[13px]">
                                <img src="' . asset('admin-theme/assets/images/add-people.png') . '" class="w-[16px] mr-[11px] object-contain">
                                <p>Trackables</p>
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('projects.destroy', $project->id) . '" method="POST" onsubmit="return confirm(\'Are you sure?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="flex items-center text-[#344563] text-[13px] manrope-medium">
                                    <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[16px] mr-[11px] object-contain">
                                    <p>Delete</p>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>';
    }
}
