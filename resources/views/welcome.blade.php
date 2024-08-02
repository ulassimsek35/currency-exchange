<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Döviz Kuru</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="./assets/css/main.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid px-5 mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-center">Döviz Kurları</h1>
                <table class="table mt-3 exchanges">
                    <thead>
                        <tr>
                            <th>Para Birimi</th>
                            <th>Alış</th>
                            <th>Satış</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="input-group">
                    <input type="text" id="date" class="form-control dateInput" placeholder="Lütfen Tarih Seçiniz">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="text-center">Cüzdan</h1>
                    
                <table class="table mt-3 wallet">
                    <thead>
                        <tr>
                            <th>Döviz Birimi</th>
                            <th>Miktar</th>
                            <th>Toplam Ödenen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wallet as $currency => $amount)
                            @if ($currency !== 'USDLira' && $currency !== 'EURLira')
                                <tr>
                                    <td>{{ $currency }}</td>
                                    <td class="{{ $currency == 'USD' ? 'usdWallet' : ($currency == 'EUR' ? 'eurWallet' : '') }}">
                                        {{ number_format($amount, 3, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ number_format($wallet[$currency . 'Lira'] ?? 0, 3, ',', '.') }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h3 class="text-center mt-5">İŞLEM YAP</h3>
        <p class="text-center">(Formun açılması için başarılı tarih seçimi yapmalısınız)</p>
        
        <div class="d-flex justify-content-center align-items-center">
            <div class="customForm">
                <form class="text-center" id="exchangeForm" action="{{ route('store.transaction') }}" method="post">
                    @csrf
                    <div class="form-group form-inline justify-content-center">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" value="buy" name="buySellType" id="buyBox" checked>
                            <label class="form-check-label" for="buyBox">
                              Al
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="sell" name="buySellType" id="sellBox">
                            <label class="form-check-label" for="sellBox">
                              Sat
                            </label>
                        </div>
                    </div>
                    <select class="form-select selectCurrency" aria-label="Döviz Türü Seçiniz" name="currency">
                        <option value="0" selected>Döviz Türü Seçiniz</option>
                        <option value="USD">Dolar(ABD)</option>
                        <option value="EUR">Euro</option>
                    </select>

                    <div class="mt-3 mb-3 amountDiv">
                        <input type="text" class="form-control" placeholder="Tutar(Döviz)" readonly name="amount">
                    </div>

                    <div class="mt-3 mb-3 resultDiv">
                        <input type="text" class="form-control" placeholder="..." readonly name="resultLira">
                    </div>

                    <button type="submit" class="btn btn-light">İşlem Yap</button>
                </form>
            </div>
        </div>

        <div class="transactionHistory">
            <h2 class="text-center">İŞLEM GEÇMİŞİ</h2>
                    
            <table class="table mt-3 wallet">
                <thead>
                    <tr class="text-center">
                        <th>Döviz Birimi</th>
                        <th>Miktar</th>
                        <th>Kar(+)/Zarar(-)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactionHistory as $currency => $amount)
                    <tr class="text-center">
                        <td>{{ $currency }}</td>
                        <td>{{ number_format($completedAmount[$currency], 3, ',', '.') }}</td>
                        <td>{{ number_format($amount, 3, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>
