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
                // Assuming Mapping has a relationship with Company
                return $mapping->company ? $mapping->company->company_name : 'N/A';
            })
            ->editColumn('project_name', function ($mapping) {
                // Assuming Mapping has a relationship with Project
                return $mapping->project ? $mapping->project->name : 'N/A';
            })
            ->editColumn('plant_name', function ($mapping) {
                return $mapping->project->plant_name ?? 'N/A';
            })
            ->editColumn('camera_name', function ($mapping) {
                return $mapping->camera->equipment_name ?? 'N/A';
            })
            ->editColumn('tablet_name', function ($mapping) {
                return $mapping->tablet->equipment_name ?? 'N/A';
            })
            ->editColumn('streaming_links', function ($mapping) {
                return '
                    <div class="w-72 relative">
                        <span class="truncate block w-full p-2 rounded">' . ($mapping->equipment->stream_link ?? '-') . '</span>
                        <img src="' . asset('admin-theme/assets/images/copy.png') . '" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                    </div>';
            })
            ->addColumn('status', function ($mapping) {
                $status = $mapping->is_active ? 'Active' : 'Inactive';
                $color = $mapping->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$mapping->id}\" onclick=\"toggleMappingStatus({$mapping->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($mapping) {
                return '
                    <div class="flex justify-center relative">
                        <span>
                            <a href="#"><img src="' . asset('admin-theme/assets/images/more.png') . '" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event, this)"></a>
                        </span>
                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                            <ul>
                                <li class="py-[5px]">
                                    <a href="javascript:void(0);" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="showEditMappingModal(' . $mapping->id . ')">
                                        <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="w-[16px] mr-[11px] object-contain">
                                        <p>Edit</p>
                                    </a>
                                </li>
                                <li class="py-[5px]">
                                    <form action="' . route('mappings.destroy', $mapping->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this mapping?\');">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[15px]">
                                            <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[16px] mr-[11px] object-contain">
                                            <p>Delete</p>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>';
            })
            ->rawColumns(['checkbox', 'streaming_links', 'status', 'action']);
    }

    public function query(Mapping $model)
    {
        return $model->newQuery()
            ->select('mapping.*')
            ->leftJoin('companies', 'mapping.company_id', '=', 'companies.id')
            ->leftJoin('projects', 'mapping.project_id', '=', 'projects.id')
            ->with(['company', 'project']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('mappings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('checkbox')->title('')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('company_name')->title('Company Name')->addClass('text-left'),
            Column::make('project_name')->title('Project Name')->addClass('text-left'),
            Column::make('plant_name')->title('Plant Name')->addClass('text-left'),
            Column::make('camera_name')->title('Camera Name')->addClass('text-center'),
            Column::make('tablet_name')->title('Tablet Name')->addClass('text-center'),
            Column::make('streaming_links')->title('Streaming Links')->addClass('text-left'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::make('action')->title('Action')->addClass('text-center')->orderable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Mapping_' . date('YmdHis');
    }
}