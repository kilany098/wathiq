<?php

namespace App\DataTables;

use App\Models\stock;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StockDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<stock> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('item', function ($stock) {
                return $stock->item->name;
            })
             ->addColumn('code', function ($stock) {
                return $stock->item->code;
            })
            ->addColumn('warehouse', function ($stock) {
                return $stock->warehouse->name;
            });
           
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<stock>
     */
    public function query(stock $model): QueryBuilder
    {
        $query= $model->newQuery()->where('quantity','<',15);
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('stock-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(4)
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
            Column::make('item')->title(__('item')),
            Column::make('code')->title(__('code')),
            Column::make('warehouse')->title(__('warehouse')),
            Column::make('quantity')->title(__('quantity')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Stock_' . date('YmdHis');
    }
}
