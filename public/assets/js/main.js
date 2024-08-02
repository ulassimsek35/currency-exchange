$(document).ready(function() {
    $('.dateInput').datepicker({
        format: 'dd/mm/yyyy',
        language: 'tr',
        autoclose: true
    }).on('changeDate', function(e) {
        let selectedDate = e.format('yyyy-mm-dd'); //datepickerda seçilmiş tarih
        let $formSelector = $('.customForm'); // 3 kez kullandığım için değişkene atadım
        $.ajax({
            url: '/exchanges',
            type: 'GET',
            data: { date: selectedDate },
            success: function(data) {
                if (data.error) {
                    $('.exchanges tbody').html('<tr><td colspan="3">' + data.error + '</td></tr>');
                    $formSelector.css('display','none');
                } else {
                    let rows = '';
                    $.each(data.Currency, function(index, value) {
                        let buyPriceClass = value.Isim == 'EURO' ? 'buyPriceEUR' : 'buyPriceUSD'; // satışta miktarın oto gelmesini istiyorum, fiyata erişmek için class 
                        let sellPriceClass = value.Isim == 'EURO' ? 'sellPriceEUR' : 'sellPriceUSD';
                        if (value.Isim == 'EURO' || value.Isim == 'ABD DOLARI') {
                            rows += '<tr>' +
                                '<td>' + value.Isim + '</td>' +
                                '<td class="' + buyPriceClass + '">' + parseFloat(value.BanknoteBuying).toFixed(3) + '</td>' +
                                '<td class="' + sellPriceClass + '">' + parseFloat(value.BanknoteSelling).toFixed(3) + '</td>' +
                            '</tr>';
                        }
                    });
                    $('.exchanges tbody').html(rows);
                    $formSelector.css('display','block');
                }
            },
            error: function() {
                $('.exchanges tbody').html('<tr><td colspan="3">Bir hata oluştu. Seçtiğiniz tarih gelecek ve haftasonundan olmamalı</td></tr>');
                $formSelector.css('display','none');
            }
        });
    });

    ifSellChecked();
    isSelected();
    calculateCurrency();
    submitForm();
});

function ifSellChecked() { // satışta miktarın oto gelmesi
    $('.selectCurrency').on('change', function() {
        let isCheckedSell = $('#sellBox').is(':checked');
        let eurAmount = 0;
        let usdAmount = 0;

        if (isCheckedSell) {
            let selectedCurrency = $(this).val();

            if (selectedCurrency == 'USD'){
                usdAmount = parseFloat($('.usdWallet').text().replace('.','').replace(',','.'));
                $('.amountDiv input').val(usdAmount);
            }else if (selectedCurrency == 'EUR') {
                eurAmount = parseFloat($('.eurWallet').text().replace('.','').replace(',','.'));
                $('.amountDiv input').val(eurAmount);
            }

            $('.amountDiv input').trigger('keyup');
        } 
    });
}

function isSelected() { // selectedta seçili varsa readonly
    $('.selectCurrency').on('change', function() {
        let selectedValue = $(this).val();

        if(selectedValue !== "0"){
            $('.amountDiv input').removeAttr('readonly');
        } else {
            $('.amountDiv input').attr('readonly',true);
        }
    });
}

function calculateCurrency() { // kullanıcının alım yaparken ekrana girdiği miktarın direkt tl karşılığını görmesi için
    $('.amountDiv input').on('keyup', function() {
        let amountValue = $(this).val();
        let isSellChecked = $('#sellBox').is(':checked');
        let currency = $('.selectCurrency').val();
        let usdCurrency = '';
        let eurCurrency = '';
        let resultLira = 0;

        if (amountValue !== '') {
            if(currency == 'USD') { 
                usdCurrency = parseFloat(isSellChecked ? $('.buyPriceUSD').text().replace(',','.') : $('.sellPriceUSD').text().replace(',','.'));
                resultLira = amountValue * usdCurrency;
                resultLira = resultLira.toFixed(3).replace('.',',');
                $('.resultDiv input').val(resultLira + ' Türk Lirası');
            }else if (currency == 'EUR') {
                eurCurrency = parseFloat(isSellChecked ? $('.buyPriceEUR').text().replace(',','.') : $('.sellPriceEUR').text().replace(',','.'));
                resultLira = amountValue * eurCurrency;
                resultLira = resultLira.toFixed(3).replace('.',',');
                $('.resultDiv input').val(resultLira + ' Türk Lirası');
            }
        }
    });
}

function submitForm() {
    $('#exchangeForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('İşlem başarıyla kaydedildi!');
                location.reload();
            },
            error: function(xhr) {
                alert('Bir hata oluştu.');
            }
        });
    });
}
