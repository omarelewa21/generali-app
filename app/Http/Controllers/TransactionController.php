<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TransactionLogsDataTable;

class TransactionController extends Controller
{
    public function index(Request $request,TransactionLogsDataTable $dataTable)
    {
        return $dataTable->render('pages.dashboard.logs');
    }
}
