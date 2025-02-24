<?php

namespace App\DataTables;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InventoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'inventory.action')

            ->addColumn('add_new', function ($query) {
                return "<a href='#' data-bs-toggle='modal' data-bs-target='#add_stock'
                    data-item-id='{$query->id}'
                        class='btn btn-light fs-12 fw-semibold me-3'>Add Stock</a>";
            })
            ->addColumn('allocate', function ($query) {
                return "<a href='#' data-bs-toggle='modal' data-bs-target='#assign_item'
                    data-item-assign-id='{$query->id}'
                        class='btn btn-light fs-12 fw-semibold me-3'>Allocate</a>";
            })
            ->rawColumns(['action', 'add_new', 'allocate'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Inventory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('inventory-table')
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
            Column::make('item_name'),
            Column::make('total_stock'),
            Column::make('supplied_stock'),
            Column::make('remaining_stock'),
            Column::make('add_new'),
            Column::make('allocate'),
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
        return 'Inventory_' . date('YmdHis');
    }
}
