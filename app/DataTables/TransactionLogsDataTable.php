<?php

namespace App\DataTables;

use App\Models\SessionStorage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Transaction;

class TransactionLogsDataTable extends DataTable
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
                    $button = '<button style="background-color: grey;" class="btn btn-secondary btn-sm w-80" disabled>Continue</button>';
                } else {
                    $button = '<a href="' . route('basic.details', ['transaction_id' => $data->transaction_id]) . '" class="btn btn-primary btn-sm w-80">Continue</a>';
                }
                return $button;
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
                return $data->customer->id_number ?? "-";
            })
            ->orderColumn('id_number', function ($query, $order) {
                $query->join('customers', 'transactions.customer_id', '=', 'customers.id')
                      ->orderBy('customers.id_number', $order);
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->timezone('Asia/Kuala_Lumpur')->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->timezone('Asia/Kuala_Lumpur')->format('Y-m-d');
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model)
    {
        $transactionId = request()->input('searchTransaction');
        $customerName = request()->input('searchName');
        $status = request()->input('searchStatus');
        $customerId = request()->input('searchID');
        $fromDate =  request()->get('min');
        $toDate =  request()->get('max');
        
        // $query = $model->newQuery()->withTrashed();

        $query = $model->whereIn('status',['completed','cancelled'])
                       ->with(['customer' => function ($query) {
                        $query->select('customers.id', 'customers.full_name', 'customers.id_number');
                        }])
                        ->withTrashed();

       
        if ($customerId){
            $query->where('customers.id', $customerId);
        }

        if ($transactionId){
            $query->where('transactions.id', $transactionId);
        }

        if($customerName)
        {
            $query->whereHas('customer', function ($query) use ($customerName) {
                $query->where('full_name', 'LIKE', "%$customerName%");
            });
        }

        if ($status){
            $query->where('transactions.status', $status);
        }

        if ($fromDate){
            $query->whereDate('transactions.created_at', '>=', $fromDate);
        }

        if ($toDate){
            $query->whereDate('transactions.created_at', '<=', $toDate);
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transactionlogs-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0,'asc')
                    // ->selectStyleSingle()
                    ->parameters([
                        'buttons' => [],
                    ])
                    ->autoWidth(true)
                    ->responsive(true)
                    ->dom( 
                          "<'row'<'col-sm-12'tr>>" . 
                          "<'row'<'col-sm-12 col-md-5'i>
                          <'col-sm-12 col-md-7'p>>"
                        )
                    ->columnDefs([
                        [
                            'targets' => [0,2,3,4,5],
                            'className' => 'dt-center',
                        ],
                        [
                            'targets' => 3,
                            'render' => 'function (data, type, row) {
                                var status = data.toLowerCase();
                    
                                // Add class based on status
                                var statusClass = status === "completed" ? "text-green" : (status === "cancelled" ? "text-red" : "text-yellow");
                    
                                // Customize the HTML output based on the status and class
                                return "<div class=\'" + statusClass + "\'>" + data + "</div>";
                            }',
                        ],
                    ]);            
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
           
            Column::make('id')->title('No.'),
            Column::make('full_name')->title('Customer Name'),
            Column::make('id_number')->title('Customer Id'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Date of Completion'),
            // Column::make('updated_at')->title('Modified'),
            Column::make('action')->title('Action')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TransactionLogs_' . date('YmdHis');
    }
}
