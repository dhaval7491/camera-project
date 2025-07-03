<?php

namespace App\DataTables;

use App\Models\Mapping;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MappingDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($mapping) {
                return '
                <div class="text-center">
                    <input type="checkbox" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>';
            })
            ->editColumn('company_name', function ($mapping) {
                return $mapping->company_name ?? 'N/A';
            })
            ->editColumn('project_name', function ($mapping) {
                return $mapping->project_name ?? 'N/A';
            })
            ->editColumn('camera_name', function ($mapping) {
                return $mapping->camera_name ?? 'N/A';
            })
            ->editColumn('tablet_name', function ($mapping) {
                return $mapping->tablet_name ?? 'N/A';
            })
            ->addColumn('status', function ($mapping) {
                $status = $mapping->is_active ? 'Active' : 'Inactive';
                $color = $mapping->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-[12px] font-medium cursor-pointer\" data-id=\"{$mapping->id}\" onclick=\"toggleMappingStatus({$mapping->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($mapping) {
                return '
                <ul class="flex justify-start align-items-center">
                        <li class="py-[5px]">
                            <a href="javascript:void(0);"  onclick="showEditMappingModal(' . $mapping->id . ')" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="mt-[4px] w-[20px] mr-[11px] object-contain">
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('mappings.destroy', $mapping->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this equipment?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[15px]">
                                    <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[20px] h-[20px] mr-[11px] object-contain">
                                </button>
                            </form>
                        </li>
                </ul>';
            })
            ->orderColumn('status', 'is_active $1')
            ->rawColumns(['checkbox', 'status', 'action']);
    }

    public function query(Mapping $model)
    {
        $query = $model->newQuery()
            ->select(
                'mapping.*',
                'companies.company_name',
                'projects.name as project_name',
                'camera_equipment.equipment_name as camera_name',
                'tablet_equipment.equipment_name as tablet_name',
                'camera_equipment.stream_link as streaming_links'
            )
            ->leftJoin('companies', 'mapping.company_id', '=', 'companies.id')
            ->leftJoin('projects', 'mapping.project_id', '=', 'projects.id')
            ->leftJoin('equipments as camera_equipment', 'mapping.camera_id', '=', 'camera_equipment.id')
            ->leftJoin('equipments as tablet_equipment', 'mapping.tablet_id', '=', 'tablet_equipment.id')
            ->with(['company', 'project']);
        // Apply company filter
        if (request()->has('mapping_company_filter') && !empty(request()->input('mapping_company_filter'))) {
            $query->whereIn('mapping.company_id', request()->input('mapping_company_filter'));
        }

        // Apply project filter
        if (request()->has('mapping_project_filter') && !empty(request()->input('mapping_project_filter'))) {
            $query->whereIn('mapping.project_id', request()->input('mapping_project_filter'));
        }

        // Apply tablet filter (filter by tablet_id)
        if (request()->has('mapping_tablet_filter') && !empty(request()->input('mapping_tablet_filter'))) {
            $query->whereIn('mapping.tablet_id', request()->input('mapping_tablet_filter'));
        }

        // Apply status filter
        if (request()->has('statuses') && !empty(request()->input('statuses'))) {
            $query->whereIn('mapping.is_active', array_map(function ($status) {
                return $status == 'Active' ? 1 : ($status == 'Inactive' ? 0 : $status);
            }, request()->input('statuses')));
        }

        return $query;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mappings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'rowCallback' => 'function(row, data, index) {
                   if (index % 2 === 1) {
                        $(row).css("background-color", "#F6F9F7"); // Even rows
                    } else {
                        $(row).css("background-color", "#ffffff"); // Odd rows
                    }
                }',
            ])
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('checkbox')->title('')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular')->orderable(false)->searchable(false)->render('function() { return \'<input type="checkbox" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0">\'; }')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular'),
            Column::make('company_name')->title('Company Name')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular'),
            Column::make('project_name')->title('Project Name')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular'),
            Column::make('camera_name')->title('Camera Name')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular'),
            Column::make('tablet_name')->title('Tablet Name')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular'),
            Column::make('status')->title('Status')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular'),
            Column::make('action')->title('Action')->addClass('text-left text-[#3D3D3D] text-[13px] manrope-regular relative')->orderable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Mapping_' . date('YmdHis');
    }
}
