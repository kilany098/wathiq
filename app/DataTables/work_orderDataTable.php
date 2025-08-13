<?php

namespace App\DataTables;

use App\Models\work_order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class work_orderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<work_order> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
             ->editColumn('due_date', function ($work_order) {
                if (!$work_order->due_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($work_order->due_date);

                return $date->format('d/m/Y');
            })
             ->editColumn('completed_at', function ($work_order) {
                if (!$work_order->completed_at) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($work_order->completed_at);

                return $date->format('d/m/Y');
            })
            ->addColumn('action', function ($work_order) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-primary align-middle fs-18 add-user" data-id="' . $work_order->id . '" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <iconify-icon icon="solar:user-rounded-outline"></iconify-icon>
                        </button>
                        <button class="btn btn-soft-warning align-middle fs-18 update-order" data-id="' . $work_order->id . '" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                        <button class="btn btn-soft-secondary align-middle fs-18 reports-order" data-id="' . $work_order->id . '" >
                            <iconify-icon icon="solar:user-id-outline"></iconify-icon>
                        </button>
                    </div>';
                return $actionHtml;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<work_order>
     */
    public function query(work_order $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('work_order-table')
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
            Column::make('order_number'),
            Column::make('contract_id'),
            Column::make('title'),
            Column::make('description'),
            Column::make('priority'),
            Column::make('status'),
            Column::make('due_date'),
            Column::make('completed_at'),
            Column::make('completion_notes'),
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
        return 'work_order_' . date('YmdHis');
    }
}
