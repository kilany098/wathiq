<?php

namespace App\DataTables;

use App\Models\tech_item;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class tech_itemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<tech_item> $query Results from query() method.
     */
    protected $userId;

    public function forUser($user_id)
    {
        $this->userId = $user_id;
        return $this;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('code', function ($tech_item) {
                return $tech_item->item->code; 
            })
            ->addColumn('name', function ($tech_item) {
                return $tech_item->item->name; 
            })
            ->addColumn('description', function ($tech_item) {
                return $tech_item->item->description; 
            });

    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<tech_item>
     */
    public function query(tech_item $model): QueryBuilder
    {
        $query= $model->newQuery();

          if ($this->userId) {
            $query->where('user_id', $this->userId);
        } else {
            // Fallback to current user if no user ID provided
            $query->where('user_id', Auth::id());
        }
         return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tech_item-table')
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
            Column::make('code'),
            Column::make('name'),
            Column::make('description'),
            Column::make('quantity'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'tech_item_' . date('YmdHis');
    }
}
