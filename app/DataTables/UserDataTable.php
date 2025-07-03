<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
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
        return datatables()
            ->eloquent($query)
            ->filter(function ($query) {
                // Global search
                if ($keyword = request('search.value')) {
                    $keyword = strtolower($keyword);

                    $query->where(function ($q) use ($keyword) {
                        $q->whereRaw('LOWER(users.name) LIKE ?', ["%{$keyword}%"])
                            ->orWhereRaw('LOWER(users.email) LIKE ?', ["%{$keyword}%"])
                            ->orWhereRaw("EXISTS (
                              SELECT 1 FROM company_user cu
                              JOIN companies c ON c.id = cu.company_id
                              WHERE cu.user_id = users.id
                              AND LOWER(c.company_name) LIKE ?
                          )", ["%{$keyword}%"])
                            ->orWhereRaw("EXISTS (
                              SELECT 1 FROM company_user cu
                              WHERE cu.user_id = users.id
                              AND LOWER(users.access_level) LIKE ?
                          )", ["%{$keyword}%"]);
                    });
                }

                // User filter
                if (request()->has('user_ids') && !empty(request('user_ids'))) {
                    $query->whereIn('users.id', request('user_ids'));
                }

                // Company filter
                if (request()->has('company_ids') && !empty(request('company_ids'))) {
                    $query->whereIn('company_user.company_id', request('company_ids'));
                }

                // Project filter
                if (request()->has('project_ids') && !empty(request('project_ids'))) {
                    $query->whereRaw("EXISTS (
                        SELECT 1 FROM project_user pu
                        WHERE pu.user_id = users.id
                        AND pu.project_id IN (" . implode(',', request('project_ids')) . ")
                    )");
                }

                // Status filter
                if (request()->has('statuses') && !empty(request('statuses'))) {
                    $mappedStatuses = array_map(function ($status) {
                        return match (strtolower($status)) {
                            'active' => 1,
                            'inactive' => 0,
                            'block' => 2,
                            default => $status
                        };
                    }, request('statuses'));

                    $query->whereIn('users.is_active', $mappedStatuses);
                }
            })
            ->editColumn('company_name', fn($user) => $user->company_name ?? 'N/A')
            ->editColumn('access_level', fn($user) => $user->access_level ?? 'N/A')
            ->editColumn('created_at', fn($user) => $user->created_at->format('M d, Y'))
            ->editcolumn('is_active', function ($user) {
                $status = $user->is_active ? 'Active' : 'Inactive';
                $color = $user->is_active ? 'bg-[#047413]' : 'bg-[#F96767]';
                return "<button class=\"table-status w-[90px] {$color} text-white rounded-[7px] py-1 px-4 text-[11px] font-medium cursor-pointer\" data-id=\"{$user->id}\" onclick=\"toggleUserStatus({$user->id})\">{$status}</button>";
            })
            ->addColumn('action', function ($user) {
                return '
                    <ul class="flex justify-start align-items-center">
                        <li class="py-[5px]"><a href="' . route('users.show', $user->id) . '" class="flex manrope-regular text-[#344563] font-normal text-[13px]">
                            <img src="' . asset('admin-theme/assets/images/view.png') . '" class="mt-[4px] w-[20px] mr-[11px] object-contain"></a>
                        </li>
                        <li class="py-[5px]"><a href="javascript:void(0);" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="showEditModal(' . $user->id . ')">
                            <img src="' . asset('admin-theme/assets/images/edit-opt.png') . '" class="mt-[0px] w-[20px] mr-[11px] object-contain"></a>
                        </li>
                        <li class="py-[5px]">
                            <form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="flex items-center manrope-regular text-[#344563] font-normal text-[13px]">
                                    <img src="' . asset('admin-theme/assets/images/delete.png') . '" class="w-[20px] h-[20px] mr-[11px] object-contain">
                                </button>
                            </form>
                        </li>
                    </ul>';
            })
           ->rawColumns(['is_active', 'action'])
           ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
            ->leftJoin('company_user', 'users.id', '=', 'company_user.user_id')
            ->leftJoin('companies', 'company_user.company_id', '=', 'companies.id')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.is_active',
                'users.created_at',
                'users.access_level',
                DB::raw("(SELECT GROUP_CONCAT(c.company_name SEPARATOR ', ')
              FROM company_user cu
              JOIN companies c ON c.id = cu.company_id
              WHERE cu.user_id = users.id) as company_name")
            ])
           ->groupBy('users.id', 'users.name', 'users.email', 'users.is_active', 'users.created_at', 'users.access_level');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            'name' => ['title' => 'Name', 'searchable' => true, 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
            'email' => ['title' => 'Email', 'searchable' => true , 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
            'company_name' => ['title' => 'Company', 'searchable' => false , 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
            'access_level' => ['title' => 'Access Level', 'searchable' => false , 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
            'is_active' => ['title' => 'Status', 'searchable' => false , 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
            'created_at' => ['title' => 'Created At', 'searchable' => true , 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
            'action' => ['title' => 'Action', 'orderable' => false, 'searchable' => false , 'className' => 'text-left text-[#344563] text-[12px] manrope-regular'],
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
