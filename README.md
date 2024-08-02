# Döviz Kuru Uygulaması / Currency Exchange Application

Bu proje, kullanıcıların döviz kurlarını takip edebileceği, geçmiş döviz kurlarını sorgulayabileceği ve cüzdanlarında bulunan dövizleri yönetebileceği bir web uygulamasıdır. Laravel framework'ü kullanılarak geliştirilmiştir.

This project is a web application where users can track exchange rates, query past exchange rates, and manage the currencies in their wallets. It is developed using the Laravel framework.

## Özellikler / Features

- Güncel döviz kurlarını görüntüleme / Viewing current exchange rates
- Belirli bir tarihe ait döviz kurlarını sorgulama / Querying exchange rates for a specific date
- Cüzdan özelliği ile döviz birimlerinin miktarlarını ve toplam ödenen tutarlarını görüntüleme / Viewing amounts and total paid amounts of currency units with the wallet feature
- Alım ve satım işlemleri yaparak döviz cüzdanını güncelleme / Updating the currency wallet by performing buy and sell transactions
- Yapılan işlemlerin geçmişini görüntüleme / Viewing the history of transactions

## Kullanım / Usage

### Döviz Kurları / Exchange Rates

Anasayfada güncel döviz kurlarını ve belirli bir tarihe ait döviz kurlarını görüntüleyebilirsiniz. Tarih seçimi yaparak, o tarihteki döviz kurlarını sorgulayabilirsiniz.

On the homepage, you can view current exchange rates and exchange rates for a specific date. You can query exchange rates for a particular date by selecting a date.

### Cüzdan / Wallet

Sağ tarafta bulunan cüzdan bölümünde, sahip olduğunuz döviz birimlerinin miktarlarını ve toplam ödenen tutarlarını görüntüleyebilirsiniz.

In the wallet section on the right, you can view the amounts and total paid amounts of the currencies you own.

### Alım ve Satım İşlemleri / Buy and Sell Transactions

Tarih seçimi yapıldıktan sonra alım veya satım işlemi gerçekleştirebilirsiniz. Döviz birimi ve miktarını seçerek işlemi tamamlayabilirsiniz.

After selecting a date, you can perform a buy or sell transaction. Complete the transaction by selecting the currency unit and amount.

### İşlem Geçmişi / Transaction History

Alt kısımda, daha önce yapılan alım ve satım işlemlerinin geçmişini görüntüleyebilirsiniz.

At the bottom, you can view the history of previously performed buy and sell transactions.

## Proje Yapısı / Project Structure

- `welcome.blade.php`: Ana görünüm dosyası, kullanıcı arayüzü ve HTML yapısı burada bulunur.
- `main.js`: JavaScript dosyası, tarih seçimi ve alım/satım işlemleri gibi işlevleri içerir.
- `ExchangeRateController.php`: Döviz kurlarını almak için kullanılan kontrolör.
- `TransactionController.php`: Alım ve satım işlemlerini kaydetmek için kullanılan kontrolör.
- `WalletController.php`: Cüzdan ve işlem geçmişini yönetmek için kullanılan kontrolör.

- `welcome.blade.php`: Main view file containing the user interface and HTML structure.
- `main.js`: JavaScript file containing functionalities such as date selection and buy/sell transactions.
- `ExchangeRateController.php`: Controller used to fetch exchange rates.
- `TransactionController.php`: Controller used to save buy and sell transactions.
- `WalletController.php`: Controller used to manage the wallet and transaction history.



Bu proje MIT Lisansı ile lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına bakabilirsiniz.

This project is licensed under the MIT License. For more information, see the `LICENSE` file.
