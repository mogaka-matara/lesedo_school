<?php

namespace App\DataTables;

use App\Models\FeeComponent;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use function Sodium\add;

class FeeComponentDataTable extends DataTable
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
            ->addColumn('term_name', function ($query) {
                return $query->term->name;
            })

            ->rawColumns(['action', 'grade_name', 'term_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FeeComponent $model): QueryBuilder
    {
        return $model->newQuery()->with(['grade', 'term']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('feecomponent-table')
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
            Column::make('grade_name')->addClass('text-center'),
            Column::make('term_name')->addClass('text-center'),
            Column::make('tuition_fee')->addClass('text-center'),
            Column::make('lunch_fee')->addClass('text-center'),
            Column::make('tea_fee')->addClass('text-center'),
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
        return 'FeeComponent_' . date('YmdHis');
    }
}
