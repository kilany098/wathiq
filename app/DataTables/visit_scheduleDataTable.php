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
                        <a class="btn btn-soft-primary align-middle fs-18 add-user" href='.route('assign.index',$visit->id).' >
                            <iconify-icon icon="solar:user-rounded-outline"></iconify-icon>
                        </a>
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
            ->addColumn('branch', function ($visit) {
                return $visit->branch->name;
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
             ->filterColumn('company', function($query, $keyword) {
                $query->whereHas('contract.client', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('branch', function($query, $keyword) {
                $query->whereHas('branch', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('city', function($query, $keyword) {
                $query->whereHas('branch.city', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('zone', function($query, $keyword) {
                $query->whereHas('branch.zone', function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
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
                    ])
                    ->initComplete("function() {
                    // Create a container for search inputs in card-body
                    var searchContainer = $('<div class=\"row mb-3\" id=\"custom-search-container\"></div>');
                    $('.card-body').prepend(searchContainer);
                    
                    // Add search inputs for each column
                    this.api().columns().every(function(index) {
                        var column = this;
                        var title = $(column.header()).text().trim();
                        
                        // Skip action and status columns
                        if(title === 'Action' || title === 'Status' || title === 'Id') return;
                        
                        // Create column wrapper
                        var colDiv = $('<div class=\"col-md-2 mb-2\"></div>');
                        
                        // Create label
                        var label = $('<label class=\"form-label\">').text(title);
                        
                        // Create input
                        var input = $('<input type=\"text\" class=\"form-control form-control-sm\">')
                            .attr('placeholder', 'Search '+title)
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                        
                        // Append to container
                        colDiv.append(label).append(input);
                        searchContainer.append(colDiv);
                    });
                }");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [    
            Column::make('id')->title(__('id')),
            Column::make('company')->title(__('company')),
            Column::make('branch')->title(__('branch')),
            Column::make('city')->title(__('city')),
            Column::make('zone')->title(__('zone')),
            Column::make('month')->title(__('month')),
            Column::make('visits_count')
            ->title(__('visits count'))
            ->addClass('text-center'),
            Column::make('status')->title(__('status')),
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
        return 'visit_schedule_' . date('YmdHis');
    }
}
