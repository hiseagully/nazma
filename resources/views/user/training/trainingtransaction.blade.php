<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>NaZMaLogy Training Transaction</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <x-header></x-header>
  @include('components.trainingsearchbox', ['action' => '/training/search'])
  <link rel="stylesheet" href="{{ asset('css/training/trainingtransaction.css') }}">
</head>
<body class="bg-[#f5f8ff] min-h-screen flex flex-col">
  <main class="main-content">
    <section aria-label="Transaction section" class="transaction-section">
      <h2 class="section-title">Transaction</h2>

      @forelse($transactions as $transaction)
      <article class="transaction-item">
        <img 
          alt="{{ $transaction->training->trainingtitle }} cover image"
          class="transaction-img"
          src="{{ asset('storage/training_images/' . $transaction->training->training_image_url) }}"
          height="80" width="80"
        />
        <div class="transaction-info">
          <p class="transaction-title">{{ $transaction->training->trainingtitle }}</p>
          <p class="transaction-status {{ strtolower($transaction->trainingtransactionstatus) }}">
            Status: {{ $transaction->trainingtransactionstatus }}
          </p>

          @if (strtolower($transaction->trainingtransactionstatus) === 'pending')
            <button
              class="pay-button bg-orange-500 text-white px-4 py-2 mt-2 rounded hover:bg-orange-600"
              data-transaction-id="{{ $transaction->trainingtransactionid }}"
              data-snap-token="{{ $transaction->snap_token }}" {{-- pastikan kamu sudah punya tokennya --}}
            >
              Pay Now
            </button>
          @endif
          <p>Transaction ID: {{ $transaction->trainingtransactionid }}</p>
        </div>
        <div class="transaction-meta">
          <time>{{ \Carbon\Carbon::parse($transaction->trainingtransactiondate)->format('d F Y H:i') }}</time>
          <p>Total: Rp {{ number_format($transaction->trainingtransactiontotal, 0, ',', '.') }}</p>
        </div>
      </article>
      @empty
      <p>No transactions found.</p>
      @endforelse

    </section>
  </main>
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

  <script>
    document.querySelectorAll('.pay-button').forEach(button => {
      button.addEventListener('click', function () {
        const snapToken = this.getAttribute('data-snap-token');
        window.snap.pay(snapToken, {
          onSuccess: function(result){
            alert("Payment success!"); // Bisa arahkan ke redirect atau reload
            location.reload();
          },
          onPending: function(result){
            alert("Waiting for payment...");
          },
          onError: function(result){
            alert("Payment failed.");
          },
          onClose: function(){
            alert('You closed the popup without finishing the payment.');
          }
        });
      });
    });
  </script>

  <x-footer></x-footer>
</body>
</html>