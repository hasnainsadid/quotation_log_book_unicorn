<?php
namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', fn($row) => view('backend.pages.users.partials._action', compact('row'))->render())
            ->editColumn('role', fn($row) =>
                optional($row->roles->first())->name
            )
            ->editColumn('is_active', fn($row) => $row->is_active
                ? '<span class="badge bg-label-success">Active</span>'
                : '<span class="badge bg-label-danger">Inactive</span>')
            ->editColumn('address', fn($row) => wordwrap($row->address, 30, "<br>", true))
            ->filterColumn('role', function ($q, $keyword) {
                $q->whereHas('roles', fn($r) => $r->where('name', 'like', "%{$keyword}%"));
            })
            ->rawColumns(['address', 'role', 'is_active', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('roles');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle();
        //         ->buttons([
        //             Button::make('excel'),
        // Button::make('csv'),
        // Button::make('pdf'),
        // Button::make('print'),
        // Button::make('reset'),
        // Button::make('reload')
        //         ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = [
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('designation'),
            Column::make('role')->orderable(false),
            Column::make('address'),
            Column::make('is_active')->title('Status')->addClass('text-center'),
        ];
        if (hasPermission(['users.edit', 'users.destroy', 'users.status'])) {
            $columns[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center');
        }

        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}