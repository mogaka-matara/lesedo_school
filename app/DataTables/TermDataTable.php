<?php

namespace App\DataTables;

use App\Models\Term;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TermDataTable extends DataTable
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
                $editBtn = "<a href='".route('term.edit', $query->id)."' class='edit btn btn-primary'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('term.edit', $query->id)."' class='edit btn btn-danger '><i class='fa fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;

            })
            ->addColumn('grade_name', function ($query) {
                return $query->grade->name;
            })

            ->rawColumns(['action', 'grade_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Term $model): QueryBuilder
    {
        return $model->newQuery()->with('grade');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('term-table')
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
            Column::make('id')->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            Column::make('grade_name')->addClass('text-center'),
            Column::make('tuition_fee')->addClass('text-center'),
            Column::make('tea_fee')->addClass('text-center'),
            Column::make('lunch_fee')->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Term_' . date('YmdHis');
    }
}
