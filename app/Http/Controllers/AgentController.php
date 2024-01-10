<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SessionsDataTable;
use App\DataTables\TransactionLogsDataTable;
use App\Models\SessionStorage;
use Illuminate\Support\Facades\Log;


class AgentController extends Controller
{
    public function index(Request $request,SessionsDataTable $dataTable)
    {
        $status = $request->query('status');


        // $statuses = ['completed', 'draft', 'cancelled'];
        // $statusCounts = [];

        // foreach ($statuses as $status) {
        //     $statusCounts[$status] = SessionStorage::where('status', $status)->count();
        // }
        // $statusCounts = SessionStorage::selectRaw('status, COUNT(*) as count')
        //                 ->groupBy('status')
        //                 ->get();

        $completedCount = SessionStorage::where('status', 'completed')->count() ?? 0;
        $draftCount = SessionStorage::where('status', 'draft')->count() ?? 0;
        $cancelledCount = SessionStorage::where('status', 'cancelled')->count() ?? 0;

        $grandTotal = $completedCount + $draftCount + $cancelledCount;

        $dataTable->setStatus($status);

        return $dataTable->render('pages.dashboard.agent',compact('completedCount','draftCount','cancelledCount','grandTotal'));
    }

    public function softDelete($id)
    {
        $item = SessionStorage::find($id);

        if ($item) {
            $item->status = 'cancelled';
            $item->save();
            // $item->delete(); // Soft delete
        }

        return redirect()->back()->with('success', 'Item soft deleted successfully.');
    }
}
