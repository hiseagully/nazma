<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>NaZMaLogy Training Ticket Content</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <x-header></x-header>
@include('components.trainingsearchbox', ['action' => '/training/search'])
    <link rel="stylesheet" href="{{ asset('css/training/trainingticketdetail.css') }}" />
</head>
<body class="flex flex-col min-h-screen">
  <!-- Main content only -->
  <main class="flex-grow">
    <section aria-labelledby="training-ticket-title" class="ticket-section">
      <h2 id="training-ticket-title" class="ticket-title">Training Ticket</h2>
      <div class="ticket-card">
        <div class="ticket-header">
          <div class="ticket-info">
            <img
              alt="Workshop Contract Development poster with a man in black suit and orange and blue background"
              class="ticket-image"
              height="80"
              src="https://storage.googleapis.com/a1aa/image/28034d58-8416-43dc-505d-5542eab346cf.jpg"
              width="80"
            />
            <div class="ticket-text">
              <span class="ticket-name">Workshop Contract Development</span>
              <span class="ticket-status">Upcoming</span>
              <span class="ticket-transaction-id"
                >Training Transaction ID: 12723HUEGW973</span
              >
            </div>
          </div>
          <div class="ticket-date">21-22 Mei 2025</div>
        </div>
        <form class="ticket-form">
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input
              id="email"
              type="email"
              readonly
              value="rraaras@gmail.com"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label for="address" class="form-label">Address</label>
            <input
              id="address"
              type="text"
              readonly
              value="Yogyakarta, Special Region of Yogyakarta, Indonesia."
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label for="fullname" class="form-label">Full Name</label>
            <input
              id="fullname"
              type="text"
              readonly
              value="Raras Prawisti"
              class="form-input"
            />
          </div>
          <div class="form-group">
            <label for="dob" class="form-label">Date of Birth</label>
            <input
              id="dob"
              type="text"
              readonly
              value="Klaten, 3 Desember 2008"
              class="form-input"
            />
          </div>
          <div class="form-actions">
            <a href="/trainingticket" type="button" class="btn-back">Back</a>
          </div>
        </form>
      </div>
    </section>
  </main>
  <x-footer></x-footer>
</body>
</html>