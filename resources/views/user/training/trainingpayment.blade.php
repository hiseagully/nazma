<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h1>Processing Payment...</h1>

    <script type="text/javascript">
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('payment.success') }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('payment.success') }}";
            },
            onError: function(result){
                alert("Payment Failed!");
                console.log(result);
            },
            onClose: function() {
                alert('Payment popup closed without completing payment');
            }
        });
    </script>
</body>
</html>