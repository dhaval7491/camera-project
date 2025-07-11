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
                return '<a href="' . route('trackables.show', $trackable->id) . '"><p class="manrope-regular text-[#344563] font-normal text-[11px]">' . $trackable->trackable_name . '</p></a>';
            })
            ->editColumn('other_name', function ($trackable) {
                return '<p class="manrope-regular text-[#344563] font-normal text-[11px]">' . $trackable->other_name . '</p>';
            })
            ->editColumn('linked_objects', function ($trackable) {
                $objects = $trackable->linkedObjects->pluck('name')->implode(', ');
                return '<p class="manrope-regular text-[#344563] font-normal text-[11px]">' . ($objects ?: 'N/A') . '</p>';
            })
            ->editColumn('status', function ($trackable) {
                $status = $trackable->is_active ? 'Active' : 'Inactive';
                $color = $trackable->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-[11px] font-medium cursor-pointer\" data-id=\"{$trackable->id}\" onclick=\"toggleTrackableStatus({$trackable->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($trackable) {
                return '<ul class="flex justify-start align-items-center">
                        <li class="py-[5px]">
                            <a href="javascript:void(0);"  onclick="showTrackableEditModal(' . $trackable->id . ')" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="mt-[0px] w-[16px] h-[16px] mr-[11px] mr-[11px] object-contain">
                            </a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('trackables.destroy', $trackable->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this equipment?\');">
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
            ->rawColumns(['checkbox', 'trackable_name', 'other_name', 'linked_objects', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Trackable $model): QueryBuilder
    {
        $query = $model->newQuery()->with('linkedObjects');

        // Apply trackable name filter
        if (request()->has('trackable_name_filter') && !empty(request()->input('trackable_name_filter'))) {
            $query->whereIn('trackables.id', request()->input('trackable_name_filter'));
        }

        // Apply type filter (other_name)
        if (request()->has('trackable_type_filter') && !empty(request()->input('trackable_type_filter'))) {
            $query->whereIn('trackables.other_name', request()->input('trackable_type_filter'));
        }

        // Apply status filter
        if (request()->has('statuses') && !empty(request()->input('statuses'))) {
            $query->whereIn('trackables.is_active', array_map(function ($status) {
                return $status == 'Active' ? 1 : ($status == 'Inactive' ? 0 : $status);
            }, request()->input('statuses')));
        }

        return $query;
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
                'rowCallback' => 'function(row, data, index) {
                   if (index % 2 === 1) {
                        $(row).css("background-color", "#F6F9F7"); // Even rows
                    } else {
                        $(row).css("background-color", "#ffffff"); // Odd rows
                    }
                }',
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
                ->render('function() { return \'<input type="checkbox" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0">\'; }')->addClass('check-block text-left text-[#344563] text-[13px] manrope-regular') ->addClass('text-left text-[#344563] text-[13px] manrope-regular'),
            Column::make('trackable_name')->title('Trackable Name')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('other_name')->title('Other Name')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('linked_objects')->title('Linked Objects')->orderable(false)->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::make('status')->title('Status')->addClass('text-left text-[#344563] text-[11px] manrope-regular'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-left'),
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
