<?php

namespace App\DataTables;

use App\Models\Student;
use App\Models\Term;
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
                $showBtn = "<a href='".route('student.show', $query->id)."' class='edit btn btn-primary me-2 '><i class='fa fa-circle-info'></i></a>";
                $editBtn = "<a href='".route('student.edit', $query->id)."' class='edit btn btn-primary me-2'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('student.destroy', $query->id)."' class='edit btn btn-danger '><i class='fa fa-trash-alt'></i></a>";

                return $showBtn  .  $editBtn . $deleteBtn;
            })
            ->addColumn('fee_collection', function ($query) {
                return "<a href='#' data-bs-toggle='modal' data-bs-target='#add_fees_collect'
                    data-student-id='{$query->id}'
                        data-term-id='{$query->term_id}'
                        class='btn btn-light fs-12 fw-semibold me-3'>Collect Fees</a>";
            })

            ->addColumn('total_fee', function ($query) {
                return number_format($query->term_amount_paid, 2);
            })
            ->addColumn('active_term', function ($student) {
                $activeTerm = Term::getActiveTerm();
                if ($activeTerm && $student->term_id === $activeTerm->id) {
                    return $activeTerm->name;
                }
                return "Term One";
            })
            ->addColumn('arrears', function ($student) {
                $activeTerm = Term::getActiveTerm();
                if ($activeTerm && $student->term_id === $activeTerm->id) {
                    return $student->term_arrears > 0
                        ?  number_format($student->term_arrears, 2)
                        : 'Fully Paid';
                }
                return number_format(0, 2);
            })

            ->addColumn('overpayment', function ($student) {
                return $student->overpayment > 0
                    ? number_format($student->overpayment, 2)
                    : number_format(0, 2);
            })

            ->addColumn('status', function ($query) {
                $badgeClass = $query->term_status === 'Pending' ? 'badge rounded-pill bg-danger' : 'badge rounded-pill bg-success';
                return '<span class="badge ' . $badgeClass . '">' . $query->term_status . '</span>';
            })
            ->addColumn('academic_year', function ($query) {
                return $query->academicYear->name;
            })
            ->rawColumns(['action', 'fee_collection', 'amount_paid', 'arrears', 'status', 'active_term', 'overpayment'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Student $model): QueryBuilder
    {
        return $model->newQuery()->with('academicYear');
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
            Column::make('academic_year'),
            Column::make('total_fee')->addClass('text-center'),
            Column::make('arrears'),
            Column::make('active_term'),
            Column::make('status'),
            Column::make('overpayment'),
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
