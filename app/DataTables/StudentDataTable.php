<?php

namespace App\DataTables;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='".route('student.edit', $query->id)."' class='edit btn btn-primary'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('student.destroy', $query->id)."' class='edit btn btn-danger '><i class='fa fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('fee_collection', function ($query) {
                return "<a href='#' data-bs-toggle='modal' data-bs-target='#add_fees_collect'
                    data-student-id='{$query->id}'
                        data-term-id='{$query->id}'
                        class='btn btn-light fs-12 fw-semibold me-3'>Collect Fees</a>";
            })

            ->addColumn('amount_paid', function ($query) {
                return number_format($query->term_amount_paid, 2);
            })
            ->addColumn('arrears', function ($query) {
                return number_format($query->term_arrears, 2);
            })

            ->addColumn('status', function ($query) {
                $badgeClass = $query->term_status === 'Pending' ? 'badge rounded-pill bg-danger' : 'badge rounded-pill bg-success';
                return '<span class="badge ' . $badgeClass . '">' . $query->term_status . '</span>';
            })
            ->rawColumns(['action', 'fee_collection', 'amount_paid', 'arrears', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Student $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('student-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('gender'),
            Column::make('date_of_birth'),
            Column::make('parent_email'),
            Column::make('parent_name'),
            Column::make('parent_contact'),
            Column::make('amount_paid'),
            Column::make('arrears'),
            Column::make('status'),
            Column::make('fee_collection'),
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
        return 'Student_' . date('YmdHis');
    }
}
