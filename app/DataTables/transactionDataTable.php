<?php

namespace App\DataTables;

use App\Models\transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class transactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<transaction> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
             ->addColumn('item', function ($transaction) {
                return $transaction->item->name;
            })
             ->addColumn('warehouse', function ($transaction) {
                return $transaction->warehouse->name;
            })
             ->addColumn('order_number', function ($transaction) {
                if($transaction->order == null){
                    return '-';
                }
                return $transaction->order->order_number;
            })
            ->addColumn('created_by', function ($transaction) {
                return $transaction->creator->name;
            })
            ->editColumn('created_at', function ($transaction) {
                if (!$transaction->created_at) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($transaction->created_at);

                return $date->diffForHumans();
            });
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<transaction>
     */
    public function query(transaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transaction-table')
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
            Column::make('item'),
            Column::make('warehouse'),
            Column::make('transaction_type'),
            Column::make('quantity'),
            Column::make('order_number'),
            Column::make('created_by'),
            Column::make('notes'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'transaction_' . date('YmdHis');
    }
}
