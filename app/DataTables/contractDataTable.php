<?php

namespace App\DataTables;

use App\Models\contract;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class contractDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<contract> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
             ->addColumn('client', function ($contract) {
                return $contract->client->name;
            })
             ->addColumn('operator', function ($contract) {
                return $contract->operator->full_name;
            })
             ->editColumn('start_date', function ($contract) {
                if (!$contract->start_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($contract->start_date);

                return $date->format('d/m/Y');
            })
             ->editColumn('end_date', function ($contract) {
                if (!$contract->end_date) {
                    return '-';
                }

                $date = \Carbon\Carbon::parse($contract->end_date);

                return $date->format('d/m/Y');
            })
            ->editColumn('status', function ($contract) {
                if ($contract->status == 'new') {
                    return '<h4><span class="badge badge-soft-danger rounded-pill me-1"> new </span></h4>';
                } elseif($contract->status == 'active') {
                    return '<h4><span class="badge badge-soft-success rounded-pill me-1"> active </span></h4>';
                }elseif($contract->status == 'expired') {
                    return '<h4><span class="badge badge-soft-warning rounded-pill me-1"> expired </span></h4>';
                }elseif($contract->status == 'terminated') {
                    return '<h4><span class="badge badge-soft-warning rounded-pill me-1"> terminated </span></h4>';
                }
            })
            ->addColumn('created_by', function ($contract) {
                return $contract->creator->full_name;
            })
            ->addColumn('action', function ($contract) {
                if($contract->status == 'new'){
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-warning align-middle fs-18 update-user" data-id="' . $contract->id . '" data-bs-toggle="modal" data-bs-target="#editContractModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                        <a class="btn btn-soft-info align-middle fs-18 contract-visits" data-id="' . $contract->id . '" href='.route("allocation.index",$contract->id ).'>
                            <iconify-icon icon="solar:eye-broken"></iconify-icon>
                        </a>
                    </div>';
                    return $actionHtml;
                    }
                     $actionHtml = '
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-warning align-middle fs-18 update-user" data-id="' . $contract->id . '" data-bs-toggle="modal" data-bs-target="#editContractModal">
                            <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
                        </button>
                    </div>';
                return $actionHtml;
            })
            ->addColumn('files', function ($contract) {
                if($contract->status == 'new'){
                    return '-';
                }
                $actionHtml = '
                    <div class="d-flex gap-2">
                        <a href='. route("contract.pdf", $contract->id) .' target="_blank" class="btn btn-sm btn-soft-warning">
                       <iconify-icon icon="solar:document-medicine-bold"></iconify-icon>
                        </a>
                        <a href='. route("contract.download", $contract->id) .' class="btn btn-sm btn-secondary">
                       <iconify-icon icon="line-md:download-loop" style="color: white"></iconify-icon>
                        </a>
                    </div>';
                return $actionHtml;
            })
            ->rawColumns(['action','status','files']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<contract>
     */
    public function query(contract $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('contract-table')
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
            Column::make('id')->title(__('id')),
            Column::make('client')->title(__('client')),
            Column::make('contract_number')->title(__('contract number')),
            Column::make('type')->title(__('type')),
            Column::make('start_date')->title(__('start date')),
            Column::make('end_date')->title(__('end date')),
            Column::make('total_value')->title(__('total value')),
            Column::make('visits')->title(__('visits')),
            Column::make('payment_terms')->title(__('payment terms')),
            Column::make('terms_and_conditions')->title(__('terms and conditions')),
            Column::make('note')->title(__('note')),
            Column::make('status')->title(__('status')),
            Column::make('created_by')->title(__('created by')),
            Column::make('operator')->title(__('Operator')),
            Column::computed('files')
                ->title(__('files'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
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
        return 'contract_' . date('YmdHis');
    }
}
