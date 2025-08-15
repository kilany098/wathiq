<?php

namespace App\DataTables;

use App\Models\visit_schedule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class visit_scheduleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<visit_schedule> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($visit) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-primary align-middle fs-18 add-user" data-id="' . $visit->id . '" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <iconify-icon icon="solar:user-rounded-outline"></iconify-icon>
                        </button>
                    </div>';
                return $actionHtml;
            })
            ->editColumn('month', function ($visit) {
                if (!$visit->month) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($visit->month);
    
    // Set locale to Arabic
           // $date->locale('ar');
    
    // Format to show Arabic month name
            return $date->translatedFormat('F');
            })
            ->addColumn('city', function ($visit) {
                return $visit->branch->city->name;
            })
            ->addColumn('zone', function ($visit) {
                return $visit->branch->zone->name;
            })
            ->addColumn('company', function ($visit) {
                return $visit->contract->client->name;
            })
            ->addColumn('status', function ($visit) {
                return '<h4><span class="badge badge-soft-warning rounded-pill me-1"> unassigned </span></h4>';
            })
            ->editColumn('created_at', function ($visit) {
                if (!$visit->created_at) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($visit->created_at);

                return $date->diffForHumans();
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<visit_schedule>
     */
    public function query(visit_schedule $model): QueryBuilder
    {
        $query= $model->newQuery();
          $query->where('visits_count', '>',0);
          return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('visit_schedule-table')
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
            Column::make('city'),
            Column::make('zone'),
            Column::make('company'),
            Column::make('month'),
            Column::make('visits_count')
            ->addClass('text-center'),
            Column::make('status'),
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
        return 'visit_schedule_' . date('YmdHis');
    }
}
