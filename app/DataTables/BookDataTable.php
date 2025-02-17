<?php

namespace App\DataTables;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='".route('library.edit', $query->id)."' class=' btn btn-primary me-3'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('library.destroy', $query->id)."' class=' btn btn-danger delete-item '><i class='fa-solid fa-trash'></i></a>";

                return $editBtn . $deleteBtn;

            })

            ->addColumn('borrow_book', function ($query) {
                $isBorrowed = $query->borrowings()->where('status', false)->exists();

                if ($isBorrowed) {
                    return '<button class="btn btn-secondary fs-12 fw-semibold me-3" disabled>Borrowed</button>';
                } else {
                    return "<a href='#' data-bs-toggle='modal' data-bs-target='#assign_book'
                data-book-id='{$query->id}'
                class='btn btn-light fs-12 fw-semibold me-3'>Assign Book</a>";
                }
            })

            ->addColumn('grade_name', function ($query) {
                return $query->grade->name;
            })
            ->addColumn('subject_name', function ($query) {
                return $query->subject->name;
            })

            ->rawColumns(['action', 'grade_name', 'subject_name', 'borrow_book'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Book $model): QueryBuilder
    {
        return $model->newQuery()->with(['grade', 'borrowings']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('book-table')
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
            Column::make('grade_name'),
            Column::make('subject_name'),
            Column::make('book_name'),
            Column::make('book_no'),
            Column::make('author'),
            Column::make('publisher'),
            Column::make('quantity'),
            Column::make('borrow_book'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Book_' . date('YmdHis');
    }
}
