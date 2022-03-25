<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function listTransactions(Request $request)
    {
        return $request->user()->transactions()->latest()->take(5)->get()->map(function (MemberTransaction $item) {
            return [
                'ticket_id' => $item->ticket_id,
                'date' => $item->created_at->format('d-M-y'),
                'type' => ucfirst($item->type),
                'amount' => number_format($item->amount, 2),
                'status' => $item->status_display,
            ];
        });
    }
}
