<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('user_name', function ($user) {
                return '
                    <div class="flex">
                        <div class="mr-[15px]">
                            <img class="w-[40px] object-contain" src="' . ($user->image ? asset('storage/' . $user->image) : asset('admin-theme/assets/images/user-img.png')) . '">
                        </div>
                        <div class="text-left">
                            <h5 class="manrope-regular text-black text-[16px]">' . $user->name . '</h5>
                            <p class="manrope-regular text-[#7A86A1] text-[14px]">' . $user->email . '</p>
                        </div>
                    </div>';
            })
            ->addColumn('company_name', function ($user) {
                return $user->company ? $user->company->company_name : 'N/A';
            })
            ->addColumn('project_name', function ($user) {
                return $user->project ? $user->project->name : 'N/A';
            })
            ->addColumn('status', function ($user) {
                $status = $user->is_active ? 'Active' : 'Inactive';
                $color = $user->is_active ? 'bg-green-600' : 'bg-red-700';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer\" data-id=\"{$user->id}\" onclick=\"toggleUserStatus({$user->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($user) {
                return '
                    <ul class="flex justify-center">
                        <li class="py-[5px]"><a href="' . route('users.show', $user->id) . '" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                            <img src="' . asset('admin-theme/assets/images/view.png') . '" class="mt-[4px] w-[20px] mr-[11px] object-contain"></a>
                        </li>
                         <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="toggleModal(\'createProjectModal\', ' . $user->id . ')">
                            <img src="' . asset('admin-theme/assets/images/project.png') . '" class="mt-[4px] w-[20px] mr-[11px] object-contain" ></a>
                        </li>
                        <li class="py-[5px]"><a href="javascript:void(0);" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="showEditModal(' . $user->id . ')">
                            <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="mt-[4px] w-[20px] mr-[11px] object-contain"></a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[15px]">
                                    <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[20px] mr-[11px] object-contain">
                                </button>
                            </form>
                        </li>
                    </ul>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('F d, Y');
            })
            ->rawColumns(['user_name', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with(['company', 'project']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['excel', 'csv', 'pdf', 'print', 'reset', 'reload'],
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('user_name')->title('User Name'),
            Column::make('company_name')->title('Company Name'),
            Column::make('project_name')->title('Project Name'),
            Column::make('access_level')->title('Access Level'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Member Since'),
            Column::computed('action')
                  ->title('Action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}