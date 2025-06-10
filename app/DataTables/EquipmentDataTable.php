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
            ->editColumn('plant_name', function ($equipment) {
                return '<p class="manrope-regular text-black font-normal text-[16px] text-center">' . ($equipment->plant_name ?? '-') . '</p>';
            })
            ->editColumn('equipment_type', function ($equipment) {
                return '<p class="manrope-regular text-black font-normal text-[16px] text-center">' . ucfirst($equipment->equipment_type) . '</p>';
            })
            ->editColumn('mapped_to', function ($equipment) {
                if ($equipment->equipment_type === 'camera' && $equipment->mappingAsCamera && $equipment->mappingAsCamera->tablet) {
                    return '<p class="manrope-regular text-black font-normal text-[16px] text-center">'
                        . $equipment->mappingAsCamera->tablet->equipment_name
                        . '</p>';
                }
                return '<p class="manrope-regular text-black font-normal text-[16px] text-center">-</p>';
            })
            ->editColumn('streaming_link', function ($equipment) {
                if ($equipment->streaming_link) {
                    return '
                    <div class="w-72 relative">
                        <span class="truncate block w-full p-2 rounded">' . $equipment->streaming_link . '</span>
                        <img src="' . asset('admin-theme/assets/images/copy.png') . '" class="copy-streaming-link absolute right-0 top-[20px] w-[23px] cursor-pointer" data-link="' . $equipment->streaming_link . '">
                    </div>';
                }
                return '-';
            })
            ->addColumn('status', function ($equipment) {
                $status = $equipment->is_active ? 'Active' : 'Inactive';
                $color = $equipment->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$equipment->id}\" onclick=\"toggleEquipmentStatus({$equipment->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($equipment) {
                return '<span><a href="javascript:void(0);"><img src="' . asset('admin-theme/assets/images/more.png') . '" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                    <ul>
                        <li class="py-[5px]">
                            <a href="javascript:void(0);" onclick="showEditModal(' . $equipment->id . ')" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="w-[16px] mr-[11px] object-contain">
                                <p>Edit</p>
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('equipments.destroy', $equipment->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this equipment?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="$(this).closest(\'form\').submit();">
                                    <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[16px] mr-[11px] object-contain">
                                    <p>Delete</p>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>';
            })
            ->rawColumns(['plant_name', 'equipment_type', 'mapped_to', 'streaming_link', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Equipment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Equipment $model)
    {
        return $model->newQuery()
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
                'projects.plant_name'
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
                ->render('function() { return \'<input type="checkbox" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0">\'; }')->addClass('text-left color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('equipment_name')->title('Equipment Name')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('equipment_code')->title('Equipment Code')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('company_name')->title('Company Name')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('project_name')->title('Project Name')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('plant_name')->title('Plant Name')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('equipment_type')->title('Equipment Type')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('mapped_to')->title('Mapped To')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('streaming_link')->title('Streaming Links')->addClass('text-left color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::make('status')->title('Status')->addClass('text-center color-[#3D3D3D] text-[15px] manrope-regular'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
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
