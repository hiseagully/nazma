<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NaZMaLogy Training
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>

  @include('components.trainingsearchbox', ['action' => '/training/search'])

<link rel="stylesheet" href="{{ asset('css/training/trainingdata.css') }}">
 </head>
 <body class="page-body">
   <!-- Form and payment container -->
   <section aria-label="Trainee data and payment section" class="form-payment-section">
    <div class="form-payment-container">
    <!-- Trainee Data -->
    <form aria-labelledby="trainee-data-title" class="trainee-data-form" method="POST" action="{{ route('trainingtransaction.store', $training->trainingid) }}">
     @csrf
     <h2 id="trainee-data-title" class="form-title">
      Trainee Data
     </h2>
     <div class="form-group">
      <label class="form-label" for="email">
       Email
      </label>
      <input aria-describedby="email-desc" class="form-input email-input" id="email" name="transactiontraineeemail" placeholder="" type="email" required/>
     </div>
     <div class="form-group">
      <label class="form-label" for="fullname">
       Full Name
      </label>
      <input class="form-input" id="fullname" name="transactiontraineename" placeholder="Full Name" type="text" required/>
     </div>
     <div class="form-group">
      <label class="form-label" for="age">
       Age
      </label>
      <input class="form-input" id="age" name="transactiontraineeage" type="number" min="1" required/>
     </div>
     <fieldset class="form-group">
      <legend class="form-label">
       Gender
      </legend>
      <div class="gender-options">
       <label class="gender-label" for="male">
        <input class="gender-radio" id="male" name="transactiontraineegender" type="radio" value="m" required/>
        Male
       </label>
       <label class="gender-label" for="female">
        <input class="gender-radio" id="female" name="transactiontraineegender" type="radio" value="f" required/>
        Female
       </label>
      </div>
     </fieldset>
     <div class="form-group">
      <label class="form-label" for="address">
       Address
      </label>
      <textarea class="form-textarea" id="address" name="transactiontraineeaddress" placeholder="Address" rows="4" required></textarea>
     </div>
     <!-- Payment section moved inside form for submission -->
     <aside aria-labelledby="payment-title" class="payment-aside">
      <h2 class="form-title" id="payment-title">
       Payment
      </h2>
      <div class="payment-info">
       <img
        alt="{{ $training->trainingtitle }}"
        class="payment-img"
        height="64"
        src="{{ asset('storage/training_images/' . $training->trainingimage) }}"
        width="64"
       />
       <div>
        <h3 class="payment-title">
         {{ $training->trainingtitle }}
        </h3>
        <p class="payment-date">
         {{ \Carbon\Carbon::parse($training->trainingschedule)->translatedFormat('d F Y') }}
        </p>
       </div>
      </div>
      <hr class="payment-divider"/>
      <div class="payment-total">
       <span>
        Total:
       </span>
       <span>
        Rp {{ number_format($training->trainingpricerupiah, 0, ',', '.') }}
       </span>
      </div>
      
      <div class="form-group">
       <label class="form-label" for="payment-method">
        Payment:
       </label>
       <select class="payment-select" id="payment-method" name="payment_method" required>
        <option selected disabled>
         Choose Payment
        </option>
        <option value="bank">Bank Transfer</option>
        <option value="ewallet">E-Wallet</option>
       </select>
      </div>
      <button class="checkout-button" type="submit">
       Checkout
      </button>
     </aside>
    </form>
   </section>
  <x-footer></x-footer>
 </body>
</html>