<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeRateController extends Controller
{
    public function getRates(Request $request)
    {
        $date = $request->input('date');
        $formattedDate = \Carbon\Carbon::parse($date)->format('dmY');
        $yearMonth = \Carbon\Carbon::parse($date)->format('Ym');
        
        $url = "https://www.tcmb.gov.tr/kurlar/{$yearMonth}/{$formattedDate}.xml";
        
        $response = Http::get($url);

        if ($response->successful()) {
            $xmlData = simplexml_load_string($response->body());
            $jsonData = json_encode($xmlData);
            return response()->json(json_decode($jsonData, true));
        } else {
            return response()->json(['error' => 'Döviz kurları alınamadı.Lütfen geçerli bir tarih seçiniz'], 500);
        }
    }
}
