<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'buySellType' => 'required|in:buy,sell',
            'currency' => 'required|in:USD,EUR',
            'amount' => 'required|string',
            'resultLira' => 'required|string',
        ]);

        Transaction::create([
            'buy_sell_type' => $request->input('buySellType'),
            'currency' => $request->input('currency'),
            'amount' => $request->input('amount'),
            'resultLira' => str_replace(',', '.', $request->input('resultLira')),
        ]);

        return redirect()->back()->with('success', 'İşlem başarıyla kaydedildi!');
    }
}
