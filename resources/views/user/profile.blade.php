<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>NaZMaLogy Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
  </head>
  <body class="profile-page">
    <x-header></x-header>
    <main class="profile-container">
      <h2 class="profile-title">Profile</h2>
      @if(session('success'))
        <div class="alert alert-success" style="color:green;">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger" style="color:red;">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form method="POST" action="{{ route('profile.update') }}" class="profile-info">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input class="form-input disabled" id="email" type="email" value="{{ Auth::user()->user_email }}" readonly/>
        </div>
        <div class="form-group">
          <label class="form-label" for="fullname">Full Name</label>
          <input class="form-input" id="fullname" name="user_name" type="text" value="{{ Auth::user()->user_name }}" required/>
        </div>
        <div class="form-group">
          <label class="form-label" for="notelp">No Telp</label>
          <input class="form-input" id="notelp" name="user_phone" type="tel" value="{{ Auth::user()->user_phone }}" required/>
        </div>
        <div class="form-group">
          <label class="form-label">New Password <span style="color:#888;font-size:0.95em;">(min. 8 characters)</span></label>
          <input type="password" name="user_password" class="form-input" placeholder="Leave blank if not changing">
        </div>
        <div class="form-group">
          <label for="province_select" class="form-label">Province</label>
          <select id="province_select" class="form-input" required>
            <option value="">Select Province</option>
          </select>
        </div>
        <div class="form-group">
          <label for="city_select" class="form-label">City</label>
          <select id="city_select" name="district_code" class="form-input" required>
            <option value="">Select City</option>
          </select>
          <input type="hidden" name="district_name" id="district_name" value="{{ old('district_name', $user->district_name) }}">
        </div>
        <div class="form-group">
          <label for="full_address" class="form-label">Alamat Lengkap</label>
          <textarea name="full_address" id="full_address" class="form-input" rows="3" required>{{ old('full_address', Auth::user()->full_address) }}</textarea>
        </div>
        <div class="form-actions mt-6 flex justify-end gap-2">
          <button type="submit" class="btn-update bg-blue-500 hover:bg-blue-600 text-white">Update</button>
        </div>
      </form>
    </main>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          let selectedProvince = null;
          let selectedCity = null;
          // Fetch provinsi
          fetch('/api/provinces')
              .then(res => res.json())
              .then(data => {
                  let provOptions = '<option value="">Pilih Provinsi</option>';
                  data.rajaongkir.results.forEach(prov => {
                      let selected = '';
                      if (@json($user->district_name) && @json($user->district_name).startsWith(prov.province)) {
                          selected = 'selected';
                          selectedProvince = prov.province_id;
                      }
                      provOptions += `<option value="${prov.province_id}" data-prov-name="${prov.province}" ${selected}>${prov.province}</option>`;
                  });
                  document.getElementById('province_select').innerHTML = provOptions;
                  if (selectedProvince) {
                      document.getElementById('province_select').value = selectedProvince;
                      document.getElementById('province_select').dispatchEvent(new Event('change'));
                  }
              });

          // Fetch kota saat provinsi dipilih
          document.getElementById('province_select').addEventListener('change', function() {
              const provId = this.value;
              const provName = this.options[this.selectedIndex].getAttribute('data-prov-name');
              document.getElementById('city_select').innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
              document.getElementById('district_name').value = '';
              if (!provId) return;
              fetch(`/api/cities?province_id=${provId}`)
                  .then(res => res.json())
                  .then(data => {
                      let cityOptions = '<option value="">Pilih Kota/Kabupaten</option>';
                      data.rajaongkir.results.forEach(city => {
                          let combined = `${provName}, ${city.type} ${city.city_name}`;
                          let selected = '';
                          if (@json($user->district_name) === combined) {
                              selected = 'selected';
                              selectedCity = city.city_id;
                          }
                          cityOptions += `<option value="${city.city_id}" data-city-combined="${combined}" ${selected}>${city.type} ${city.city_name}</option>`;
                      });
                      document.getElementById('city_select').innerHTML = cityOptions;
                      if (selectedCity) {
                          document.getElementById('city_select').value = selectedCity;
                          document.getElementById('city_select').dispatchEvent(new Event('change'));
                      }
                  });
          });

          // Set district_name saat kota dipilih
          document.getElementById('city_select').addEventListener('change', function() {
              const selected = this.options[this.selectedIndex];
              document.getElementById('district_name').value = selected.getAttribute('data-city-combined') || '';
          });
      });
    </script>
  </body>
</html>

