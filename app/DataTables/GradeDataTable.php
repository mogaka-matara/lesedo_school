<?php

namespace App\DataTables;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GradeDataTable extends DataTable
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
                $editBtn = "<a href='".route('grade.edit', $query->id)."' class='edit btn btn-primary'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('grade.edit', $query->id)."' class='edit btn btn-danger '><i class='fa fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;

            })
            ->addColumn('date', function ($query) {
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->addColumn('tuition_fee', function ($query) {
                return number_format($query->tuition_fee, 2);
            })
            ->addColumn('exam_fee', function ($query) {
                return number_format($query->exam_fee, 2);
            })
            ->addColumn('transport_fee', function ($query) {
                return number_format($query->transport_fee, 2);
            })
            ->rawColumns(['action', 'date', 'tuition_fee'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Grade $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('grade-table')
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
            Column::make('id')->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            Column::make('tuition_fee')->addClass('text-center'),
            Column::make('exam_fee')->addClass('text-center'),
            Column::make('transport_fee')->addClass('text-center'),
            Column::make('student_total')->addClass('text-center'),
            Column::make('total_subjects')->addClass('text-center'),
            Column::make('date')->addClass('text-center'),
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
        return 'Grade_' . date('YmdHis');
    }
}
