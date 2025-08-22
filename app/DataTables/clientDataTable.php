<?php

namespace App\DataTables;

use App\Models\client;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class clientDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<client> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('branches', function ($client) {
                return $client->branches()->where('status', true)->count();
            })
            ->editColumn('tax_number', function ($client) {
                if (!$client->tax_number) {
                    return '-';
                }
                return $client->tax_number;
            })
            ->editColumn('commercial_number', function ($client) {
                if (!$client->commercial_number) {
                    return '-';
                }
                return $client->commercial_number;
            })
            ->editColumn('status', function ($client) {
                if ($client->status) {
                    return '<h4><span class="badge badge-soft-success rounded-pill me-1"> active </span></h4>';
                } else {
                    return '<h4><span class="badge badge-soft-warning rounded-pill me-1"> not active </span></h4>';
                }
            })
            ->addColumn('action', function ($client) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-warning align-middle fs-18 update-user" data-id="' . $client->id . '" data-bs-toggle="modal" data-bs-target="#editClientModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                        <a class="btn btn-soft-info align-middle fs-18 client_branches" href="/client/' . $client->id .'/branches" >
                        <iconify-icon icon="tabler:building-community"></iconify-icon>
                        </a>
                    </div>';
                return $actionHtml;
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<client>
     */
    public function query(client $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('client-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('id')->title(__('id')),
            Column::make('name')->title(__('name')),
            Column::make('contact_phone')->title(__('contact phone')),
            Column::make('email')->title(__('email')),
            Column::make('phone')->title(__('phone')),
            Column::make('tax_number')->title(__('tax number')),
            Column::make('commercial_number')->title(__('commercial number')),
            Column::make('type')->title(__('type')),
            Column::make('status')->title(__('status')),
            Column::make('branches')->title(__('branches')),
            Column::computed('action')
                ->title(__('action'))
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
        return 'client_' . date('YmdHis');
    }
}
