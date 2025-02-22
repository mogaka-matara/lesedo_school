<?php

namespace App\DataTables;

use App\Models\UniformComponent;
use App\Models\UniformTransaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UniformTransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'uniformtransaction.action')

            ->addColumn('student_name', function ($query) {
                return $query->student->first_name . ' ' . $query->student->last_name;
            })
            ->addColumn('uniform_details', function ($transaction) {
                // Fetch all uniform components for efficient querying
                $componentIds = array_column($transaction->components, 'uniform_component_id');
                $componentsMap = UniformComponent::whereIn('id', $componentIds)
                    ->pluck('name', 'id') // Create a map of ID => Name
                    ->toArray();

                // Format the components array into a readable string with names
                $details = [];
                $componentGroups = array_chunk($transaction->components, 2); // Group into pairs

                foreach ($componentGroups as $group) {
                    $groupDetails = [];
                    foreach ($group as $component) {
                        $componentName = $componentsMap[$component['uniform_component_id']] ?? 'Unknown';
                        $groupDetails[] = "{$componentName}, Quantity: {$component['quantity_issued']}, Price: Kshs: {$component['price_per_item']}";
                    }
                    $details[] = implode(' | ', $groupDetails); // Separate components in the same line with " | "
                }

                return implode('<br>', $details); // Use HTML line breaks for readability
            })

            ->rawColumns(['action', 'student_name', 'uniform_details'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(UniformTransaction $model): QueryBuilder
    {
        return $model->newQuery()->with(['student']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('uniformtransaction-table')
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
            Column::make('student_name'),
            Column::make('uniform_details'),
            Column::make('issue_date'),
            Column::make('total_price'),
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
        return 'UniformTransaction_' . date('YmdHis');
    }
}
