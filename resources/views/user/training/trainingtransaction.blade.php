<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>NaZMaLogy Training Transaction</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/training/trainingtransaction.css') }}">
</head>
<body class="bg-[#f5f8ff] min-h-screen flex flex-col">

  <x-header></x-header>
  @include('components.trainingsearchbox', ['action' => '/training/search'])

  <main class="main-content">
    <section class="transaction-section max-w-4xl mx-auto py-8">
      <h2 class="text-2xl font-semibold mb-6">Transaction</h2>

      @forelse($transactions as $transaction)
        <article class="transaction-item flex items-start gap-4 bg-white p-4 rounded shadow mb-4">
          <img 
            alt="{{ $transaction->training->trainingtitle }} cover image"
            class="w-20 h-20 object-cover rounded"
            src="{{ asset('storage/training_images/' . $transaction->training->training_image_url) }}"
          />
          <div class="flex-1">
            <p class="text-lg font-semibold">{{ $transaction->training->trainingtitle }}</p>
            <p class="text-sm text-gray-600">Status: <span class="font-bold {{ strtolower($transaction->trainingtransactionstatus) }}">{{ $transaction->trainingtransactionstatus }}</span></p>

            @if (strtolower($transaction->trainingtransactionstatus) === 'pending')
              <form action="{{ route('get.snap.token', $transaction->trainingtransactionid) }}" method="POST">
                @csrf
                <button
                  class="pay-button bg-orange-500 text-white px-4 py-2 mt-2 rounded hover:bg-orange-600"
                  type="submit"
                >
                  Pay Now
                </button>
              </form>
            @endif

            <p class="text-xs mt-1">Transaction ID: {{ $transaction->trainingtransactionid }}</p>
          </div>
          <div class="text-right text-sm">
            <time>{{ \Carbon\Carbon::parse($transaction->trainingtransactiondate)->format('d F Y H:i') }}</time>
            <p class="mt-2 font-bold">Rp {{ number_format($transaction->trainingtransactiontotal, 0, ',', '.') }}</p>
          </div>
        </article>
      @empty
        <p class="text-gray-600">No transactions found.</p>
      @endforelse
    </section>
  </main>

  <x-footer></x-footer>

</body>
</html>