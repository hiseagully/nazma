<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>NaZMaLogy Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <body class="profile-page">
    <x-header></x-header>
    <main class="profile-container">
      <h2 class="profile-title">Profile</h2>
      <div class="profile-info">
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input class="form-input disabled" id="email" type="email" value="{{ Auth::user()->user_email }}" readonly/>
        </div>
        <div class="form-group">
          <label class="form-label" for="fullname">Full Name</label>
          <input class="form-input" id="fullname" type="text" value="{{ Auth::user()->user_name }}" readonly/>
        </div>
        <div class="form-group">
          <label class="form-label" for="notelp">No Telp</label>
          <input class="form-input" id="notelp" type="tel" value="{{ Auth::user()->user_phone }}" readonly/>
        </div>
      </div>
      <div class="form-actions mt-6">
        <button class="btn-update" type="button" onclick="openEditProfileModal()">Update</button>
      </div>
      <!-- Edit Profile Modal (Popup) -->
      <div id="editProfileModal" style="position: fixed; inset: 0; z-index: 9999; display: none; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);" class="modal-overlay">
        <div class="flex justify-center items-center w-full h-full">
          <div class="profile-info bg-white rounded-xl shadow-2xl p-8 flex flex-col items-center relative" style="min-width:320px; max-width:370px; width:100%;">
            <button onclick="closeEditProfileModal()" style="position: absolute; top: 18px; right: 18px;" class="text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <h3 class="profile-title text-center mb-6">Edit Profile</h3>
            <form method="POST" action="{{ route('profile.update') }}" class="profile-form w-full">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input disabled bg-gray-100" value="{{ Auth::user()->user_email }}" readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="user_name" class="form-input" value="{{ Auth::user()->user_name }}" required>
              </div>
              <div class="form-group">
                <label class="form-label">No Telp</label>
                <input type="text" name="user_phone" class="form-input" value="{{ Auth::user()->user_phone }}" required>
              </div>
              <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="user_password" class="form-input" placeholder="Leave blank if not changing">
              </div>
              <div class="form-actions mt-6 flex justify-end gap-2">
                <button type="button" onclick="closeEditProfileModal()" class="btn-update bg-gray-200 hover:bg-gray-300 text-gray-800">Cancel</button>
                <button type="submit" class="btn-update bg-blue-500 hover:bg-blue-600 text-white">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script>
      function openEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'flex';
      }
      function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
      }
    </script>
  </body>
</html>

