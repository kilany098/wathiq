<?php

namespace App\DataTables;

use App\Models\request;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class requestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<request> $query Results from query() method.
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
             ->addColumn('item_code', function ($request) {
                return $request->item->code;
            })
             ->addColumn('warehouse_name', function ($request) {
                return $request->warehouse->name;
            })
             ->addColumn('related_order', function ($request) {
                if($request->order == null){
                    return '-';
                }
                return $request->order->order_number;
            })
            ->addColumn('created_by', function ($request) {
                return $request->creator->full_name;
            })
            ->addColumn('action', function ($request) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <form class="accept-form" action=' . route('request.accept', $request->id) . ' method="POST" style="display: inline;">
                            ' . csrf_field() . '
                            <input type="hidden" name="_method" value="POST">
                            <button type="submit" class="btn btn-soft-success align-middle fs-18 update-user">
                                <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                            </button>
                        </form>
                        <form class="accept-form" action=' . route('request.decline', $request->id) . ' method="POST" style="display: inline;">
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
     * @return QueryBuilder<request>
     */
    public function query(request $model): QueryBuilder
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
                    ->setTableId('request-table')
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
            Column::make('item_code'),
            Column::make('warehouse_name'),
            Column::make('quantity'),
            Column::make('related_order'),
            Column::make('created_by'),
            Column::make('status'),
            Column::make('notes'),
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
        return 'request_' . date('YmdHis');
    }
}
