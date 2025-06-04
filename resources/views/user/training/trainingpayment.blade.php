<!DOCTYPE html>
<html>
<head>
    <title>Training Payment</title>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h1>Payment for Transaction #{{ $transaction->id }}</h1>
    <button id="pay-button">Bayar Sekarang</button>

   <script>
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
            alert('Payment success!');
            // redirect atau reload halaman sesuai kebutuhan
            },
            onPending: function(result) {
            alert('Payment pending.');
            },
            onError: function(result) {
            alert('Payment error.');
            }
        });
    </script>
</body>
</html>
