<?php

namespace App\DataTables;

use App\Models\Equipment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EquipmentDataTable extends DataTable
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
            ->editColumn('equipment_name', function ($equipment) {
                return $equipment->equipment_name ?? '-';
            })
            ->editColumn('equipment_code', function ($equipment) {
                return $equipment->equipment_code ?? '-';
            })
            ->editColumn('company_name', function ($equipment) {
                return $equipment->company_name ?? '-';
            })
            ->editColumn('project_name', function ($equipment) {
                return $equipment->project_name ?? '-';
            })
            ->editColumn('equipment_type', function ($equipment) {
                return '<p class="manrope-regular font-normal text-[13px] text-left">' . ucfirst($equipment->equipment_type) . '</p>';
            })
            ->editColumn('mapped_to', function ($equipment) {
                if ($equipment->equipment_type === 'camera' && $equipment->mappingAsCamera && $equipment->mappingAsCamera->tablet) {
                    return '<p class="manrope-regular font-normal text-[13px] text-left">'
                        . $equipment->mappingAsCamera->tablet->equipment_name
                        . '</p>';
                }
                return '<p class="manrope-regular font-normal text-[13px] text-left">-</p>';
            })
            ->addColumn('status', function ($equipment) {
                $status = $equipment->is_active ? 'Active' : 'Inactive';
                $color = $equipment->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-[11px] font-medium cursor-pointer\" data-id=\"{$equipment->id}\" onclick=\"toggleEquipmentStatus({$equipment->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($equipment) {
                return '
                <ul class="flex justify-start align-items-center">
                        <li class="py-[5px]">
                            <a href="javascript:void(0);"  onclick="showEditModal(' . $equipment->id . ')" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="mt-[0px] w-[16px] h-[16px] mr-[11px] object-contain">
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('equipments.destroy', $equipment->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this equipment?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[15px]">
                                    <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[16px] h-[16px] mr-[11px] object-contain">
                                </button>
                            </form>
                        </li>
                </ul>';
            })
            ->orderColumn('status', 'is_active $1')
            ->rawColumns(['equipment_type', 'mapped_to', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Equipment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Equipment $model)
    {
        $query = $model->newQuery()
            ->select(
                'equipments.id',
                'equipments.equipment_name',
                'equipments.equipment_code',
                'equipments.type as equipment_type',
                'equipments.stream_link as streaming_link',
                'equipments.is_active',
                'tablet_equipment.equipment_name as mapped_to',
                'companies.company_name',
                'projects.name as project_name',
            )
            ->leftJoin('mapping', 'equipments.id', '=', 'mapping.camera_id')
            ->leftJoin('equipments as tablet_equipment', 'mapping.tablet_id', '=', 'tablet_equipment.id')
            ->leftJoin('companies', function ($join) {
                $join->on('mapping.company_id', '=', 'companies.id');
            })
            ->leftJoin('projects', function ($join) {
                $join->on('mapping.project_id', '=', 'projects.id');
            })
            ->with([
                'mappingAsCamera.company',
                'mappingAsCamera.project',
                'mappingAsTablet.company',
                'mappingAsTablet.project',
            ]);

        // Apply company filter
        if (request()->has('equipment_company_filter') && !empty(request()->input('equipment_company_filter'))) {
            $query->whereIn('mapping.company_id', request()->input('equipment_company_filter'));
        }

        // Apply project filter
        if (request()->has('equipment_project_filter') && !empty(request()->input('equipment_project_filter'))) {
            $query->whereIn('mapping.project_id', request()->input('equipment_project_filter'));
        }

        // Apply equipment filter (filter by equipment_id)
        if (request()->has('equipment_id_filter') && !empty(request()->input('equipment_id_filter'))) {
            $query->whereIn('equipments.id', request()->input('equipment_id_filter'));
        }

        // Apply status filter
        if (request()->has('statuses') && !empty(request()->input('statuses'))) {
            $query->whereIn('equipments.is_active', array_map(function ($status) {
                return $status == 'Active' ? 1 : ($status == 'Inactive' ? 0 : $status);
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
            ->setTableId('equipments-table')
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
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('')
                ->orderable(false)
                ->searchable(false)
                ->render('function() { return \'<input type="checkbox" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0">\'; }')->addClass('text-left text-[#344563] text-[13px] manrope-regular'),
            Column::make('equipment_name')->title('Equipment Name')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('equipment_code')->title('Equipment Code')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('company_name')->title('Company Name')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('project_name')->title('Project Name')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('equipment_type')->title('Equipment Type')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('mapped_to')->title('Mapped To')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('status')->title('Status')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-left text-[#344563] text-[15px] manrope-regular'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Equipment_' . date('YmdHis');
    }

    /**
     * Render the HTML table structure.
     *
     * @param array $attributes
     * @param bool $escape
     * @return \Illuminate\Support\HtmlString
     */
    public function table(array $attributes = [], bool $escape = true)
    {
        return $this->html()->table($attributes, $escape);
    }

    /**
     * Render the DataTable initialization script.
     *
     * @param array $attributes
     * @param bool $escape
     * @return \Illuminate\Support\HtmlString
     */
    public function scripts(?string $script = null, array $attributes = [])
    {
        return $this->html()->scripts($script, $attributes);
    }
}
