<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>NaZMaLogy Training</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/training/trainingdata.css') }}">
  <x-header></x-header>
  @include('components.trainingsearchbox', ['action' => '/training/search'])
</head>

<body class="page-body">
  <section aria-label="Trainee data and payment section" class="form-payment-section">
    <div class="form-payment-container">
      <div class="card-left">
        <!-- Trainee Data -->
        <form id="trainingForm" method="POST" action="{{ route('trainingtransaction.store', $training->trainingid) }}" class="trainee-data-form">
          @csrf
          <input type="hidden" name="payment_method" value="midtrans">

          <h2 class="form-title">Trainee Data</h2>

          <!-- Email -->
          <div class="form-group">
            <label class="form-label" for="email">Email</label>
              <input 
                class="form-input" 
                id="email" 
                name="transactiontraineeemail" 
                type="email" 
                value="{{ Auth::check() ? Auth::user()->user_email : '' }}" 
                readonly
                required
              >
          </div>

          <!-- Full Name -->
          <div class="form-group">
            <label class="form-label" for="fullname">Full Name</label>
            <input class="form-input" id="fullname" name="transactiontraineename" type="text" required>
          </div>

          <!-- Age -->
          <div class="form-group">
            <label class="form-label" for="age">Age</label>
            <input class="form-input" id="age" name="transactiontraineeage" type="number" min="1" required>
          </div>

          <!-- Gender -->
          <fieldset class="form-group">
            <legend class="form-label">Gender</legend>
            <label><input type="radio" name="transactiontraineegender" value="m" required> Male</label>
            <label><input type="radio" name="transactiontraineegender" value="f" required> Female</label>
          </fieldset>

          <!-- Address -->
          <div class="form-group">
            <label class="form-label" for="address">Address</label>
            <textarea class="form-textarea" id="address" name="transactiontraineeaddress" rows="4" required></textarea>
          </div>
      </div> <!-- end card-left -->

      <div class="card-right">
        <!-- Payment Section -->
        <aside class="payment-aside">
          <h2 class="form-title">Payment</h2>

          <div class="payment-info">
            <img src="{{ asset('storage/training_images/' . $training->trainingimage) }}" width="64" height="64" class="payment-img" />
            <div>
              <h3 class="payment-title">{{ $training->trainingtitle }}</h3>
              <p class="payment-date">{{ \Carbon\Carbon::parse($training->trainingschedule)->translatedFormat('d F Y') }}</p>
            </div>
          </div>

          <hr class="payment-divider">

          <div class="payment-total">
            <span>Total:</span>
            <span>Rp {{ number_format($training->trainingpricerupiah, 0, ',', '.') }}</span>
          </div>

          <!-- Checkout Button -->
          <button id="submitBtn" class="checkout-button" type="submit">Checkout</button>
        </aside>
      </div> <!-- end card-right -->
      </form> <!-- close form AFTER card-right, because form wraps both left and right -->
    </div> <!-- end form-payment-container -->
  </section>

  <!-- Midtrans Snap.js -->
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

  <!-- AJAX for Midtrans payment -->
  <script>
  document.querySelectorAll('.pay-button').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;

      fetch(`/snap/token/${id}`)                 // ← GET
        .then(r => r.json())
        .then(data => {
          if (data.snap_token) {
            window.snap.pay(data.snap_token, {
              onSuccess() { location.reload(); },
              onPending() { location.reload(); },
              onError()   { alert('Payment failed'); },
              onClose()   { /* user closed popup */ }
            });
          } else {
            alert(data.error ?? 'Snap token missing');
          }
        })
        .catch(() => alert('Network error – try again.'));
    });
  });
  </script>
  <x-footer></x-footer>
</body>
</html>
