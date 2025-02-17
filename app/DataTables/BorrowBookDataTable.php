<?php

namespace App\DataTables;

use App\Models\BorrowBook;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BorrowBookDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'borrowbook.action')
            ->addColumn('book_name', function ($query) {
                return $query->book->book_name;
            })
            ->addColumn('book_no', function ($query) {
                return $query->book->book_no;
            })


            ->addColumn('student_name', function ($query) {
                return $query->student->first_name . ' ' . $query->student->last_name;
            })
            ->addColumn('status', function ($query) {
                return $query->status
                    ? '<span class="badge rounded-pill bg-primary">Cleared</span>'
                    : '<span class="badge rounded-pill bg-danger">Borrowed</span>';
            })
            ->addColumn('return_date', function ($query) {
                return $query->returned_date
                    ? $query->returned_date
                    : '<span class="badge rounded-pill bg-warning">NOT RETURNED</span>';
            })
//            ->addColumn('return_book', function ($query) {
//                return "<a href='".route('library.return', $query->id)."' class='btn btn-light fs-12 fw-semibold me-3'>Return Book</a>";
//            })

            ->addColumn('return_book', function ($query) {
                if ($query->status === 1) {
                    return "<a href='javascript:void(0)' class='btn btn-success fs-12 fw-semibold me-3 disabled' title=''>Returned </a>";
                } else {
                    return "<a href='" . route('library.return', $query->id) . "' class='btn btn-warning fs-12 fw-semibold me-3'>Return Book</a>";
                }
            })
            ->rawColumns(['return_book', 'book_name', 'book_no', 'publisher_name', 'author_name', 'student_name',
                'student_grade', 'return_date',
                'book_grade_name', 'student_grade', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BorrowBook $model): QueryBuilder
    {
        return $model->newQuery()->with(['book', 'student']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('borrowbook-table')
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
            Column::make('book_name'),
            Column::make('book_no'),
            Column::make('student_name'),
            Column::make('return_date'),
            Column::make('borrow_date'),
            Column::make('status'),
            Column::make('return_book'),
//            Column::computed('action')
//                  ->exportable(false)
//                  ->printable(false)
//                  ->width(60)
//                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BorrowBook_' . date('YmdHis');
    }
}
