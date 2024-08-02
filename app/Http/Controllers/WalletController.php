<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class WalletController extends Controller
{
    public function index()
    {
        $currencies = ['USD', 'EUR'];
        $wallet = [];
        $transactionHistory = [];
        $completedAmount = [];
        $lastBuyAfterSell = 0;

        foreach ($currencies as $currency) {
            $buy = Transaction::where('currency', $currency)->where('buy_sell_type', 'buy')->sum('amount'); // döviz miktarları
            $sell = Transaction::where('currency', $currency)->where('buy_sell_type', 'sell')->sum('amount');

            $buyLira = Transaction::where('currency', $currency)->where('buy_sell_type', 'buy')->sum('resultLira'); // tl karşılıkları
            $sellLira = Transaction::where('currency', $currency)->where('buy_sell_type', 'sell')->sum('resultLira');

            // son satım işleminden sonraki, yani döviz bakiyesi sıfırlandıktan sonraki alım işlemleri
            $lastSellTransaction = Transaction::where('currency', $currency)->where('buy_sell_type', 'sell')->orderBy('created_at', 'desc')->first();

            if ($lastSellTransaction) {
                $lastBuyAfterSell = Transaction::where('currency', $currency)->where('buy_sell_type', 'buy')->where('created_at', '>', $lastSellTransaction->created_at)
                ->sum('resultLira'); // bu yeni alımların tl karşılıkları
            } else {
                $lastBuyAfterSell = $buyLira;
            }

            $wallet[$currency] = $buy - $sell;
            $wallet[$currency . 'Lira'] = $wallet[$currency] > 0 ? $lastBuyAfterSell : 0;
            $transactionHistory[$currency] = $buy === $sell ? ((float)$sellLira - (float)$buyLira) : 0; // alım ve satım eşitse, kar/zarar hsplaması için işlem
            $completedAmount[$currency] = $buy === $sell ? $sell : 0; // örn : 80 dolar al sat yaptığında, 160 dolar yerine 80 yazsın diye
        }

        return view('welcome', compact('wallet', 'transactionHistory', 'completedAmount'));
    }
}
