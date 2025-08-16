<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class userDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<user> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($user) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-warning align-middle fs-18 update-user" data-id="' . $user->id . '" data-bs-toggle="modal" data-bs-target="#editUserModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                        <form class="delete-form" action=' . route('user.delete', $user->id) . ' method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-soft-danger align-middle fs-18">
                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"></iconify-icon>
                            </button>
                        </form>
                    </div>';
                return $actionHtml;
            })
            ->addColumn('image', function ($user) {
                if ($user->image) {
                    return '<img class="rounded-circle" width="70" height="70" src="' . asset('storage/' . $user->image) . '" alt="Profile Image"/>';
                } else {
                    return '<img class="rounded-circle" width="70" height="70" src="/asset/admin/images/users/default-user.svg" alt="Profile Avatar">';
                }
            })
            ->addColumn('role', function ($user) {
                return $user->roles->first()->name;
            })
            ->addColumn('status', function ($user) {
                if ($user->is_active) {
                    return '<h4><span class="badge badge-soft-success rounded-pill me-1"> active </span></h4>';
                } else {
                    return '<h4><span class="badge badge-soft-warning rounded-pill me-1"> not active </span></h4>';
                }
            })
            ->editColumn('created_at', function ($user) {
                if (!$user->created_at) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($user->created_at);

                return $date->diffForHumans();
            })
            ->rawColumns(['action', 'image', 'status']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<user>
     */
    public function query(user $model): QueryBuilder
    {
        return $model->newQuery();
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
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('full_name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('role'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
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
        return 'user_' . date('YmdHis');
    }
}
