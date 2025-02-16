<?php

namespace App\DataTables;

use App\Models\StudentTermFee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'fee.action')

            ->addColumn('student_name', function ($query) {
                return $query->student->first_name . ' ' . $query->student->last_name;
            })

            ->addColumn('term_name', function ($query) {
                return $query->term->name;
            })

            ->addColumn('invoice_id', function ($query) {
                return '<a href="javascript:void(0);" class="link-primary view-invoice" data-bs-toggle="modal" data-bs-target="#view_invoice" data-id="' . $query->invoice_id . '">' . $query->invoice_id . '</a>';
            })
            ->rawColumns(['action', 'student_name', 'invoice_id'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(StudentTermFee $model): QueryBuilder
    {
        return $model->newQuery()->with(['student', 'term']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('fee-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
            Column::make('invoice_id'),
            Column::make('student_name'),
            Column::make('term_name'),
            Column::make('payment_date'),
            Column::make('amount'),
            Column::make('payment_mode'),
            Column::make('receipt_number'),
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
        return 'Fee_' . date('YmdHis');
    }
}
