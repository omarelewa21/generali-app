<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
// use App\DataTables\TransactionLogsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\DataTables\SessionsDataTable;


class AgentController extends Controller
{
    public function index(Request $request,SessionsDataTable $dataTable)
    {
        $counts = Transaction::selectRaw('status, count(*) as count')
                    ->groupBy('status')
                    ->pluck('count', 'status')
                    ->mapWithKeys(fn ($count, $status) => [$status . 'Count' => $count])
                    ->all();       

        $completedCount = $counts['completedCount'] ?? 0;
        $draftCount = $counts['draftCount'] ?? 0;
        $cancelledCount = $counts['cancelledCount'] ?? 0;

        $grandTotal = $completedCount + $draftCount + $cancelledCount;

        // $dataTable->setStatus($status);

        return $dataTable->render('pages.dashboard.agent',compact('completedCount','draftCount','cancelledCount','grandTotal'));
    }

    public function softDelete($id)
    {
        $item = SessionStorage::find($id);

        if ($item) {
            $item->status = 'cancelled';
            $item->save();
            $item->delete(); // Soft delete
        }

        return redirect()->back()->with('success', 'Item soft deleted successfully.');
    }
}