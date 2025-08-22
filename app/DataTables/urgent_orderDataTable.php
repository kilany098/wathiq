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

class urgent_orderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<work_order> $query Results from query() method.
     */
    protected $priority;

    public function forPriority($priority)
    {
        $this->priority = $priority;
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
            ->editColumn('completion_notes', function ($work_order) {
                if (!$work_order->completion_notes) {
                    return '-';
                }
                return $work_order->completion_notes; // Example: "25/12 14:30"
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
        $query = $model->newQuery();

        if ($this->priority) {
            $query->where('priority', $this->priority);
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('urgent_order-table')
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
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'urgent_order_' . date('YmdHis');
    }
}
