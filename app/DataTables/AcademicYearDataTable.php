<?php

namespace App\DataTables;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AcademicYearDataTable extends DataTable
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
                $editBtn = "<a href='".route('academic-year.edit', $query->id)."' class=' btn btn-primary me-3'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('academic-year.destroy', $query->id)."' class=' btn btn-danger delete-item '><i class='fa-solid fa-trash'></i></a>";
                $showBtn = "<a href='#' data-bs-toggle='modal' data-bs-target='#view_year'
                                data-year-name='{$query->name}'
                                data-start-date='{$query->start_date}'
                                data-end-date='{$query->end_date}'
                                data-status='{$query->status}'
                                class='btn btn-light fs-12 fw-semibold me-3'><i class='fa-solid fa-info'></i></a>";
                return $showBtn.$editBtn . $deleteBtn;

            })            ->addColumn('status', function ($academicYear) {
                $badgeClass = $academicYear->status ? 'badge bg-success rounded-pill' : 'badge bg-secondary rounded-pill';
                $badgeText = $academicYear->status ? 'Active' : 'Inactive';

                return '<span class="' . $badgeClass . '">' . $badgeText . '</span>';
            })

            ->rawColumns(['action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AcademicYear $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('academicyear-table')
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
            Column::make('name'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('status'),
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
        return 'AcademicYear_' . date('YmdHis');
    }
}
