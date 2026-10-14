<?php
namespace App\DataTables;

use App\Models\QuatationLogBook;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuatationLogBookDataTable extends DataTable
{
    // Database-er raw value ke table-e dekhanor moto kore sajay //
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('contact_numbers', fn($row) => $this->stack($row->contact_numbers))
            ->editColumn('contact_persons', fn($row) => $this->stack($row->contact_persons))
            ->editColumn('lift_size', function ($row) {
                $spec = collect([
                    $row->capacity_kg,
                    $row->passengers ? $row->passengers . 'P' : null,
                    $row->floors ? $row->floors . 'F' : null,
                ])->filter()->implode('/');

                return collect([e($row->lift_size), e($spec)])->filter()->implode('<br>');
            })
            ->addColumn('lift_brand', fn($row) => $this->stack(collect($row->offers)->pluck('brand')->all()))
            ->addColumn('given_price', fn($row) => $this->stack(
                collect($row->offers)->map(fn($o) => number_format((float) ($o['price'] ?? 0)))->all()
            ))
            ->editColumn('pq_taken_by', fn($row) => e($row->pqUser?->name ?? $row->pq_taken_by))
            ->editColumn('pq_date', fn($row) => $row->pq_date?->format('d/m/y'))
            ->addColumn('action', fn($row) => view('backend.pages.quatation-log-books.partials._action', compact('row'))->render())

            // Search support
            ->filterColumn('contact_numbers', fn($q, $k) => $q->whereRaw('CAST(contact_numbers AS CHAR) LIKE ?', ["%{$k}%"]))
            ->filterColumn('contact_persons', fn($q, $k) => $q->whereRaw('CAST(contact_persons AS CHAR) LIKE ?', ["%{$k}%"]))
            ->filterColumn('lift_brand', fn($q, $k) => $q->whereRaw('CAST(offers AS CHAR) LIKE ?', ["%{$k}%"]))
            ->filterColumn('given_price', fn($q, $k) => $q->whereRaw('CAST(offers AS CHAR) LIKE ?', ["%{$k}%"]))
            ->filterColumn('lift_size', function ($q, $k) {
                $q->whereRaw("CONCAT_WS(' ', lift_size, capacity_kg, passengers, floors) LIKE ?", ["%{$k}%"]);
            })
            ->filterColumn('pq_date', function ($q, $k) {
                $q->whereRaw("DATE_FORMAT(pq_date, '%d/%m/%y') LIKE ?", ["%{$k}%"]);
            })
            ->filterColumn('pq_taken_by', function ($q, $k) {
                $q->where(function ($w) use ($k) {
                    $w->where('pq_taken_by', 'like', "%{$k}%")
                        ->orWhereHas('pqUser', fn($u) => $u->where('name', 'like', "%{$k}%"));
                });
            })
            ->rawColumns([
                'contact_numbers', 'contact_persons', 'lift_size',
                'lift_brand', 'given_price', 'action',
            ])
            ->setRowId('id');
    }

    /**
     * Show array values one below another (escaped).
     */
    private function stack(?array $items): string
    {
        return collect($items ?? [])
            ->filter(fn($v) => filled($v))
            ->map(fn($v) => e($v))
            ->implode('<br>');
    }

    // query part, data fetch korar jonno, eikhanei condition likha hoy (with ba where diye) //
    public function query(QuatationLogBook $model): QueryBuilder
    {
        return $model->newQuery()->with('pqUser')->visible();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('quatation-log-books-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        $columns = [
            // Column::make('id')->title('Sl NO'),
            Column::make('project_name')->title('Project Name'),
            Column::make('project_address')->title('Project Address'),
            Column::make('contact_numbers')->title('Contact Number')->orderable(false),
            Column::make('contact_persons')->title('Contact Person')->orderable(false),
            Column::make('lift_size')->title('Lift Size'),
            Column::computed('lift_brand')->title('Lift Brand')->searchable(true),
            Column::computed('given_price')->title('Given Price')->searchable(true),
            Column::make('lift_quantity')->title('Lift Quantity'),
            Column::make('sub_station')->title('Sub-station'),
            Column::make('generator')->title('Generator'),
            Column::make('pq_taken_by')->title('PQ Taken By'),
            Column::make('pq_date')->title('PQ Date'),
            Column::make('remarks')->title('Remarks'),
        ];

        if (hasPermission(['quatation-log-books.edit', 'quatation-log-books.destroy'])) {
            $columns[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center');
        }

        return $columns;
    }

    protected function filename(): string
    {
        return 'QuatationLogBook_' . date('YmdHis');
    }
}
