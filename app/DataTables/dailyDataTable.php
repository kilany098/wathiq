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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class dailyDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<work_order> $query Results from query() method.
     */
       protected $assignedId;
    protected $date;

    public function forUser($assigned_id, $date = null)
    {
        $this->date = $date;
        $this->assignedId = $assigned_id;
        return $this;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
             ->addColumn('branch_name', function ($work_order) {
                return $work_order->schedule->branch->name; 
            })
            ->addColumn('city', function ($work_order) {
                return $work_order->schedule->branch->city->name; 
            })
            ->addColumn('zone', function ($work_order) {
                return $work_order->schedule->branch->zone->name; 
            })->addColumn('action', function ($work_order) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <a class="btn btn-soft-primary align-middle fs-18 add-user" href='.route('details.index',$work_order->id).' >
                            <iconify-icon icon="solar:arrow-right-outline"></iconify-icon>
                        </a>
                    </div>';
                return $actionHtml;
            });
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<work_order>
     */
    public function query(work_order $model): QueryBuilder
    {
         $query = $model->newQuery();

        // Filter by authenticated user
        if ($this->assignedId) {
            $query->where('assigned_id', $this->assignedId);
        } else {
            // Fallback to current user if no user ID provided
            $query->where('assigned_id', Auth::id());
        }

        // Filter by current day using start_date column (format: 2025-08-20 09:16:00)
        $targetDate = $this->date ? Carbon::parse($this->date) : Carbon::today();
        
        // Use whereBetween to capture the entire day
        $startOfDay = $targetDate->copy()->startOfDay();
        $endOfDay = $targetDate->copy()->endOfDay();
        
        $query->whereBetween('start_date', [$startOfDay, $endOfDay]);

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('daily-table')
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
            Column::make('branch_name'),
            Column::make('city'),
            Column::make('zone'),
            Column::make('priority'),
            Column::make('status'),
            Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'daily_' . date('YmdHis');
    }
}
