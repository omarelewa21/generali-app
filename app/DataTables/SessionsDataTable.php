<?php

namespace App\DataTables;

// use App\Models\SessionStorage;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

class SessionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                if ($data->status === 'cancelled') {
                    return '<button style="background-color: grey; padding-left:10px;margin-left: -5%;" class="btn btn-primary btn-sm w-90" disabled>Restore</button>';
                    // return '-';
                }

                // $sendButton = '<a href="' . route('send_fes',['transaction_id'=> $data->transaction_id]) . '" class="btn btn-primary btn-sm w-90">FES</a>';

                $pageRoute = str_replace(['-', '/'],".",$data->page_route);
                $button = '<a href="' . route($pageRoute, ['transaction_id' => $data->id]) . '" style="margin-left: 8%;padding-left:10px" class="btn btn-primary btn-sm w-90">Restore</a>';
                
                $dropdownToggle = '<div type="button" class="dropdown-options btn-group dropstart">
                    <a class="dropdown-toggle" style="margin-left: 40%;" data-bs-toggle="dropdown" aria-expanded="false"><img src="' . asset('images/general/more.png') . '" width="auto" height="20px" alt="More Options"></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="' . route('delete', ['id' => $data->id]) . '">Delete</a></li>
                    </ul>
                </div>';

                // $sendButton . ' '. 
                return $button . ' ' . $dropdownToggle;
            })
            ->editColumn('status', function ($data) {
                return ucfirst($data->status);
            })
            ->editColumn('full_name', function ($data) {
                return $data->customer->full_name;
            })
            ->orderColumn('full_name', function ($query, $order) {
                $query->join('customers', 'transactions.customer_id', '=', 'customers.id')
                      ->orderBy('customers.full_name', $order);
            })
            ->editColumn('id_number', function ($data) {
                return $data->customer->id_number ?? "-" ;
            })
            ->orderColumn('id_number', function ($query, $order) {
                $query->join('customers', 'transactions.customer_id', '=', 'customers.id')
                      ->orderBy('customers.id_number', $order);
            })
            ->filterColumn('full_name', function ($query, $keyword) {
                return $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->where('full_name', 'like', "%{$keyword}%");    
                });
            })
            ->filterColumn('id_number', function ($query, $keyword) {
                return $query->whereHas('customer', function ($query) use ($keyword) {
                    $query->Where('id_number', 'like', "%{$keyword}%");       
                });
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     *  @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        // $query = $model->with('customer')->withTrashed();
        $query = $model->with(['customer' => function ($query) {
            // Include the Customer model in the query
            $query->select('customers.id', 'customers.full_name', 'customers.id_number'); // Select only necessary columns to reduce query size
        }])->withTrashed();
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sessions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0,'asc')
                    ->parameters(
                        ['buttons' => [],
                    ])
                    ->responsive(true)
                    // comment for dom below
                    // 'l': Length changing (controls the "Show entries" dropdown).
                    // 'f': Filtering input (controls the search input).
                    // 't': Table.
                    // 'i': Information (displays "Showing x of y entries").
                    // 'p': Pagination.
                    ->dom('rtip')
                    ->columnDefs([
                        [
                            'targets' => '_all',
                            'className' => 'dt-center',
                        ]
                    ]); 
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('Entry Id'),
            Column::make('full_name')->title('Customer Name'),
            Column::make('id_number')->title('Customer Id'),
            Column::make('created_at')->title('Last Saved'),
            Column::make('action')->title('Action')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Sessions_' . date('YmdHis');
    }
    
}
