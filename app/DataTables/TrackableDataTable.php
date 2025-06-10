<?php

namespace App\DataTables;

use App\Models\Trackable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TrackableDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($mapping) {
                return '
                    <div class="text-center">
                        <input type="checkbox" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>';
            })
            ->editColumn('trackable_name', function ($trackable) {
                return '<a href="' .route('trackables.show', $trackable->id). '"><p class="manrope-regular text-black font-normal text-[16px]">' . $trackable->trackable_name . '</p></a>';
            })
            ->editColumn('other_name', function ($trackable) {
                return '<p class="manrope-regular text-black font-normal text-[16px]">' . $trackable->other_name . '</p>';
            })
            ->editColumn('linked_objects', function ($trackable) {
                $objects = $trackable->linkedObjects->pluck('name')->implode(', ');
                return '<p class="manrope-regular text-black font-normal text-[16px]">' . ($objects ?: 'N/A') . '</p>';
            })
            ->editColumn('status', function ($trackable) {
                $status = $trackable->is_active ? 'Active' : 'Inactive';
                $color = $trackable->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$trackable->id}\" onclick=\"toggleTrackableStatus({$trackable->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($trackable) {
                return '
                    <span><a href="javascript:void(0);"><img src="' . asset('admin-theme/assets/images/more.png') . '" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                    <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                        <ul>
                            <li class="py-[5px]">
                                <a href="javascript:void(0);" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="showTrackableEditModal(' . $trackable->id . ')">
                                    <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="w-[16px] mr-[11px] object-contain">
                                    <p>Edit</p>
                                </a>
                            </li>
                            <li class="py-[5px]">
                                <form action="' . route('trackables.destroy', $trackable->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this trackable?\');">
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
            ->orderColumn('status', 'is_active $1')
            ->rawColumns(['checkbox','trackable_name', 'other_name', 'linked_objects', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Trackable $model): QueryBuilder
    {
        return $model->newQuery()->with('linkedObjects');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('trackables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['csv', 'excel', 'pdf', 'print'],
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('')
                ->orderable(false)
                ->searchable(false)
                ->render('function() { return \'<input type="checkbox" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm">\'; }'),
            Column::make('trackable_name')->title('Trackable Name'),
            Column::make('other_name')->title('Other Name'),
            Column::make('linked_objects')->title('Linked Objects')->orderable(false),
            Column::make('status')->title('Status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Trackable_' . date('YmdHis');
    }
}
