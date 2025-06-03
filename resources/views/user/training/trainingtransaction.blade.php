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
  <x-footer></x-footer>
</body>
</html>