<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>NaZMaLogy Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <x-header></x-header>
  </head>
  <body class="profile-page">
    <main class="profile-container">
      <h2 class="profile-title">Profile</h2>
      <form class="profile-form">
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input class="form-input disabled" id="email" type="email" value="rraaras@gmail.com" readonly/>
        </div>
        <div class="form-group">
          <label class="form-label" for="fullname">Full Name</label>
          <input class="form-input" id="fullname" type="text" value="Raras Prawisti"/>
        </div>
        <div class="form-group">
          <label class="form-label" for="notelp">No Telp</label>
          <input class="form-input" id="notelp" type="tel" value="+628130986365"/>
        </div>
        <div class="form-actions">
          <button class="btn-update" type="submit">Update</button>
        </div>
      </form>
    </main>
  </body>
</html>

