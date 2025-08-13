<?php

namespace App\DataTables;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BranchDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Branch> $query Results from query() method.
     */
protected $clientId;

public function forClient($client_id)
    {
        $this->clientId = $client_id;
        return $this;
    }



    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
          return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('created_at', function ($branch) {
                if (!$branch->created_at) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($branch->created_at);

                return $date->diffForHumans();
            })
            ->editColumn('city', function ($branch) {
                return $branch->city->name;
            })
            ->editColumn('zone', function ($branch) {
                return $branch->zone->name;
            })
            ->editColumn('status', function ($branch) {
                if ($branch->status) {
                    return '<h4><span class="badge badge-soft-success rounded-pill me-1"> active </span></h4>';
                } else {
                    return '<h4><span class="badge badge-soft-warning rounded-pill me-1"> not active </span></h4>';
                }
            })
            ->addColumn('action', function ($branch) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-warning align-middle fs-18 update-user" data-id="' . $branch->id . '" data-bs-toggle="modal" data-bs-target="#editBranchModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                    </div>';
                return $actionHtml;
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Branch>
     */
    public function query(Branch $model): QueryBuilder
    {
        $query = $model->newQuery();
       
        if ($this->clientId) {
            $query->where('client_id', $this->clientId);
        }
        
        return $query;


    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('branch-table')
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
            Column::make('manager_name'),
            Column::make('manager_phone'),
            Column::make('city'),
            Column::make('zone'),
            Column::make('map_link'),
            Column::make('status'),
            Column::make('created_at'),
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
        return 'Branch_' . date('YmdHis');
    }
}
