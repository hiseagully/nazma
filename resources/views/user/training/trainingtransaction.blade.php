<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NaZMaLogy Training Transaction
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>
  <x-trainingsearchbox></x-trainingsearchbox>
  <link rel="stylesheet" href="{{ asset('css/training/trainingtransaction.css') }}">
 </head>
 <body class="bg-[#f5f8ff] min-h-screen flex flex-col">
  <!-- Main content -->
  <main class="main-content">
   <section aria-label="Transaction section" class="transaction-section">
    <h2 class="section-title">
     Transaction
    </h2>
    <!-- Transaction item 1 -->
    <article aria-label="Transaction item with payment success" class="transaction-item">
     <img alt="Workshop Contract Development cover image with a man in black shirt and blue background with orange details" class="transaction-img" height="80" src="https://storage.googleapis.com/a1aa/image/6001bec1-bd35-4d07-cc33-14e5f203b9ff.jpg" width="80"/>
     <div class="transaction-info">
      <div>
       <p class="transaction-title">
        Workshop Contract Development
       </p>
       <p class="transaction-status success">
        <i class="fas fa-check-circle">
        </i>
        Payment Success
       </p>
      </div>
      <p class="transaction-id">
       Transaction ID : 27sb5weg29
      </p>
     </div>
     <div class="transaction-meta">
      <time class="transaction-time">
       29 April 2025 8.42 WIB
      </time>
      <p class="transaction-total">
       Total : Rp200.000
      </p>
     </div>
    </article>
    <!-- Transaction item 2 -->
    <article aria-label="Transaction item waiting for payment" class="transaction-item">
     <img alt="Workshop Contract Development cover image with a man in black shirt and blue background with orange details" class="transaction-img" height="80" src="https://storage.googleapis.com/a1aa/image/6001bec1-bd35-4d07-cc33-14e5f203b9ff.jpg" width="80"/>
     <div class="transaction-info">
      <div>
       <p class="transaction-title">
        Workshop Contract Development
       </p>
       <p class="transaction-status waiting">
        <i class="fas fa-clock">
        </i>
        Waiting for Payment
       </p>
      </div>
      <p class="transaction-id">
       Transaction ID : 27sb5weg29
      </p>
     </div>
     <div class="transaction-meta">
      <time class="transaction-time">
       29 April 2025 8.42 WIB
      </time>
      <p class="transaction-total">
       Total : Rp200.000
      </p>
     </div>
    </article>
    <!-- Transaction item 3 -->
    <article aria-label="Transaction item with payment expired" class="transaction-item">
     <img alt="Workshop Contract Development cover image with a man in black shirt and blue background with orange details" class="transaction-img" height="80" src="https://storage.googleapis.com/a1aa/image/6001bec1-bd35-4d07-cc33-14e5f203b9ff.jpg" width="80"/>
     <div class="transaction-info">
      <div>
       <p class="transaction-title">
        Workshop Contract Development
       </p>
       <p class="transaction-status expired">
        <i class="fas fa-ban">
        </i>
        Payment Expired
       </p>
      </div>
      <p class="transaction-id">
       Transaction ID : 27sb5weg29
      </p>
     </div>
     <div class="transaction-meta">
      <time class="transaction-time">
       29 April 2025 8.42 WIB
      </time>
      <p class="transaction-total">
       Total : Rp200.000
      </p>
     </div>
    </article>
   </section>
  </main>
    <x-footer></x-footer>
 </body>
</html>