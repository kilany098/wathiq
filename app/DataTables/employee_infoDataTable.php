<?php

namespace App\DataTables;

use App\Models\employee_info;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class employee_infoDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<employee_info> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($employee_info) {
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-warning align-middle fs-18 update-user" data-id="' . $employee_info->id . '" data-bs-toggle="modal" data-bs-target="#editUserModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                    </div>';
                return $actionHtml;
            })
            ->addColumn('full_name', function ($employee_info) {
                return $employee_info->user->full_name;
            })
            ->editColumn('hire_date', function ($employee_info) {
                if (!$employee_info->hire_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($employee_info->hire_date);

                return $date->format('d/m/Y');
            })
            ->editColumn('termination_date', function ($employee_info) {
                if (!$employee_info->termination_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($employee_info->termination_date);

                return $date->format('d/m/Y');
            })

            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<employee_info>
     */
    public function query(employee_info $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employee_info-table')
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
            Column::make('full_name'),
            Column::make('employee_number'),
            Column::make('hire_date'),
            Column::make('termination_date'),
            Column::make('salary'),
            Column::make('emergency_contact'),
            Column::make('emergency_phone'),
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
        return 'employee_info_' . date('YmdHis');
    }
}
