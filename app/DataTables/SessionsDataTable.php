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

                if ($data->status === 'cancelled') {
                    // return '<button style="background-color: grey; padding-left:10px" class="btn btn-primary btn-sm w-100" disabled>Restore</button>';

                    return '-';
                }

                $button = '<a href="' . route('basic.details', ['transaction_id' => $data->transaction_id]) . '" class="btn btn-primary btn-sm w-90">Restore</a>';
                
                $dropdownToggle = '<div type="button" class="dropdown-options btn-group dropstart">
                    <a class="dropdown-toggle" style="margin-left: 500%;" data-bs-toggle="dropdown" aria-expanded="false"><img src="https://generali.zenotechmy.com/images/general/icon-more.png" width="auto" height="20px" alt="More Options"></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="' . route('delete', ['id' => $data->id]) . '">Delete</a></li>
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
     * Get the query source of dataTable.
     *  @param \App\Models\SessionStorage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SessionStorage $model)
    {
        $query = $model->newQuery()->withTrashed();

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
                    ->dom("<'row'<'col-sm-12 col-md-6'l>  
                                 <'col-sm-12 col-md-6'f>>" . 
                          "<'row'<'col-sm-12'tr>>" . 
                          "<'row'<'col-sm-12 col-md-5'i>
                          <'col-sm-12 col-md-7'p>>"
                        )
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
            Column::make('transaction_id')->title('Entry Id'),
            Column::make('customer_name')->title('Customer Name'),
            Column::make('customer_id')->title('Customer Id'),
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
