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

class SessionsDataTable extends DataTable
{
    protected $status;
    protected $data;

    public function __construct($status = null, $data = null)
    {
        $this->status = $status;
        $this->data = $data;
    }
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
                $button = '<a href="' . route('basic.details', ['id' => $data->transaction_id]) . '" class="btn btn-primary btn-sm w-90">Restore</a>';
                
                $dropdownToggle = '<div type="button" class="dropdown-options btn-group dropstart">
                    <a class="dropdown-toggle" style="margin-left: 500%;" data-bs-toggle="dropdown" aria-expanded="false"><img src="https://generali.zenotechmy.com/images/general/icon-more.png" width="auto" height="20px" alt="More Options"></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </div>';

                return $button . ' ' . $dropdownToggle;
            })
            ->editColumn('status', function ($data) {
                return ucfirst($data->status);
            })
            ->rawColumns(['action']);
    }

    
    public function setStatus($status)
    {
        $this->status = $status;  
        
        return $this;
    }

     /**
     * Set the data for the DataTable instance.
     *
     * @param  \Illuminate\Support\Collection|array  $data
     * @return $this
     */

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the query source of dataTable.
     *  @param \App\Models\SessionStorage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SessionStorage $model)
    {
        $query = $model->newQuery();

        $allStatuses = ['completed','draft','cancelled'];

        // Apply the status filter if it is set
        if ($this->status !== null){
            if (in_array($this->status,$allStatuses)){
                $query->where('status', $this->status);
            }
            else
            {
                $query->whereIn('status', $allStatuses);
            }
            // Reset the status property after using it in a query
            $this->status = NULL;
        }
        return $this->applyScopes($query);
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
                    ->parameters([
                        'buttons' => [],
                    ])
                    ->responsive(true)
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
            Column::make('transaction_id')->title('Transaction Id'),
            Column::make('customer_name')->title('Customer Name'),
            Column::make('customer_id')->title('Customer Id'),
            Column::make('created_at')->title('Last Saved'),
            Column::make('action')->title('Action')->orderable(false)->searchable(false),
            Column::make('status')->title('Status'),
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
