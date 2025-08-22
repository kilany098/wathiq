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

class pending_orderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<work_order> $query Results from query() method.
     */
    protected $status;

    public function forStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('start_time', function ($work_order) {
                if (!$work_order->start_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($work_order->start_date);

                return $date->format('d/m H:i'); // Example: "25/12 14:30"
            })
            ->addColumn('end_time', function ($work_order) {
                if (!$work_order->end_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($work_order->end_date);

                return $date->format('d/m H:i'); // Example: "25/12 14:30"
            })
            ->editColumn('assigned_to', function ($work_order) {
                return $work_order->assigned->full_name; // Example: "25/12 14:30"
            })
            ->addColumn('action', function ($work_order) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <form class="accept-form" action=' . route('request.accept', $work_order->id) . ' method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            <input type="hidden" name="_method" value="POST">
                            <button type="submit" class="btn btn-soft-success align-middle fs-18 update-user">
                                <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                            </button>
                        </form>
                        <form class="accept-form" action=' . route('request.decline', $work_order->id) . ' method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            <input type="hidden" name="_method" value="POST">
                            <button type="submit" class="btn btn-soft-danger align-middle fs-18 client_branches">
                                <iconify-icon icon="solar:close-circle-broken"></iconify-icon>
                            </button>
                        </form>
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
        $query = $model->newQuery();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pending_order-table')
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
            Column::make('id'),
            Column::make('order_number'),
            Column::make('title'),
            Column::make('description'),
            Column::make('priority'),
            Column::make('status'),
            Column::make('start_time'),
            Column::make('end_time'),
            Column::make('assigned_to'),
            Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'pending_order_' . date('YmdHis');
    }
}
