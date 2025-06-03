<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>
   NaZMaLogy Product Data
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>
  <x-productsearchbox></x-productsearchbox>
  <link rel="stylesheet" href="{{ asset('css/product/productdata.css') }}">
 </head>
 <body class="page-body">
   <!-- Form and payment container -->
   <section aria-label="Trainee data and payment section" class="form-payment-section">
    <div class="form-payment-container">
    <!-- Trainee Data -->
    <form aria-labelledby="trainee-data-title" class="trainee-data-form" id="trainee-form">
     <h2 id="trainee-data-title" class="form-title">
      Recipient Data
     </h2>
     <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input bg-gray-100" value="{{ Auth::user()->user_email ?? Auth::user()->email }}" readonly>
              </div>
     <div class="form-group">
      <label class="form-label">Name</label>
      <input type="text" class="form-input bg-gray-100" value="{{ Auth::user()->user_name ?? Auth::user()->name }}" readonly>
     </div>
     <div class="form-group">
      <label class="form-label" for="recipient-phone">
       Phone Number
      </label>
      <input type="tel" class="form-input" id="recipient-phone" name="recipient_phone" placeholder="08xxxxxxxxxx" required>
      <div id="phone-error" class="text-red-500 text-xs mt-1 hidden">Phone number is required</div>
     </div>
     <div class="form-group">
      <label class="form-label" for="recipient-country">Country</label>
      <select class="form-input text-sm font-normal w-full border border-gray-300 rounded-md py-3 px-4 placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="recipient-country" name="recipient_country" required>
        <option value="" disabled>Select Country</option>
        <option value="ID">Indonesia</option>
        <option value="INTL" selected>International</option>
      </select>
     </div>
     <div class="form-group" id="address-indonesia-group">
      <label class="form-label">Provinsi</label>
      <select id="province_id_select" name="province_id_select" class="form-input mb-2" required>
        <option value="">Pilih Provinsi</option>
      </select>
      <label class="form-label mt-2">Kabupaten/Kota</label>
      <select id="city_id" name="city_id" class="form-input" required>
        <option value="">Pilih Kabupaten/Kota</option>
      </select>
      <input type="hidden" id="province_id" name="province_id">
      <input type="hidden" id="province_name" name="province_name">
      <input type="hidden" id="city_name" name="city_name">
      <div id="address-error" class="text-red-500 text-xs mt-1 hidden">Address is required</div>
     </div>
     <div class="form-group hidden" id="address-international-group">
      <label class="form-label" for="recipient-country-list">Country</label>
      <select class="form-input text-sm font-normal w-full border border-gray-300 rounded-md py-3 px-4 placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="recipient-country-list" name="recipient_country_list">
        <option value="" disabled selected>Select Country</option>
        <!-- Opsi negara dunia via JS -->
      </select>
      <label class="form-label mt-2" for="recipient-city">City</label>
      <input type="text" class="form-input" id="recipient-city" name="recipient_city" placeholder="City" />
     </div>
     <div class="form-group">
      <label class="form-label" for="recipient-fulladdress">
       Full Address
      </label>
      <textarea class="form-textarea" id="recipient-fulladdress" name="recipient_fulladdress" placeholder="Street, RT/RW, Building, etc" rows="3" required></textarea>
      <div id="fulladdress-error" class="text-red-500 text-xs mt-1 hidden">Full address is required</div>
     </div>
    </form>
    
<section
      aria-labelledby="payment-title"
      class="bg-white rounded-xl p-6 w-full max-w-md shadow-md flex flex-col justify-between">
      <h2 class="font-bold text-lg" id="payment-title">Payment</h2>
      <div id="payment-product-list" class="mt-0"><!-- Akan diisi JS --></div>
      <div class="flex justify-between font-semibold text-sm">
        <span>Total Purchase:</span>
        <span id="total-purchase">$ 0.00</span>
      </div>
      <div class="flex flex-col gap-4">
        <div>
          <label class="block font-semibold mb-1" for="payment-method">Payment:</label>
          <select aria-required="true" class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="payment-method">
            <option class="text-gray-300" disabled selected>Choose Payment</option>
            <option>Credit Card</option>
            <option>Bank Transfer</option>
            <option>Paypal</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold mb-1" for="courier">Courier:</label>
          <select aria-required="true" class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="courier">
            <option class="text-gray-300" disabled selected>Choose Courier</option>
            <option value="jne">JNE</option>
            <option value="pos">POS Indonesia</option>
            <option value="tiki">TIKI</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold mb-1">Ongkir:</label>
          <span id="shipping_cost">Rp 0</span>
          <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="0">
        </div>
      </div>
      <div class="flex justify-between font-semibold text-sm mt-4">
        <span>Total Payment:</span>
        <span id="total-payment">$ 0.00</span>
      </div>
      <a href="/producttransaction">
        <button id="checkout-btn" class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold py-3 rounded-full hover:brightness-110 transition" type="button">Checkout</button>
      </a>
    </section>
   </section>
  </main>
  <x-footer></x-footer>
 </body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Ambil produk terpilih dari localStorage
  const selected = localStorage.getItem('selectedCartItems');
  let currencySymbol = '$';
  let isID = false;
  // Fungsi untuk update simbol mata uang
  function updateCurrencySymbol() {
    const countrySelect = document.getElementById('recipient-country');
    isID = countrySelect && countrySelect.value === 'ID';
    currencySymbol = isID ? 'Rp' : '$';
    // Update semua .currency-symbol
    document.querySelectorAll('.currency-symbol').forEach(el => {
      el.textContent = currencySymbol;
    });
    // Update total
    updateTotals();
  }
  // Render produk dan total
  function updateTotals() {
    const products = selected ? JSON.parse(selected) : [];
    let total = 0;
    const paymentList = document.getElementById('payment-product-list');
    if (paymentList) {
      paymentList.innerHTML = '';
      products.forEach((item, idx) => {
        // Pilih harga sesuai country
        let unitPrice = isID ? (item.productpricerupiah || 0) : (item.productpricedollar || 0);
        unitPrice = parseFloat(unitPrice) || 0;
        const qty = parseFloat(item.qty || 1);
        const subtotal = unitPrice * qty;
        // Format harga tanpa ,00 jika bulat
        function formatPrice(val) {
          return val % 1 === 0 ? val.toLocaleString(undefined, {maximumFractionDigits:0}) : val.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
        }
        paymentList.innerHTML += `
          <div class="flex gap-4 items-center py-3">
            <img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0"/>
            <div class="flex-1 min-w-0 flex flex-col">
              <span class="text-xs text-gray-500">${item.category}</span>
              <span class="font-semibold text-sm truncate whitespace-nowrap overflow-hidden block" title="${item.name}">${item.name}</span>
              <span class="text-xs text-gray-600">Qty: ${item.qty}</span>
            </div>
            <div class="flex flex-col items-end min-w-[90px]">
              <span class="font-semibold text-sm whitespace-nowrap"><span class="currency-symbol">${currencySymbol}</span> ${formatPrice(unitPrice)}</span>
              <span class="text-xs text-gray-500 whitespace-nowrap">Subtotal: <span class="currency-symbol">${currencySymbol}</span> ${formatPrice(subtotal)}</span>
            </div>
          </div>
          <hr class="border-gray-300 m-0" />
        `;
        total += subtotal;
      });
    }
    // Update total purchase dan total payment
    const totalPurchase = document.getElementById('total-purchase');
    if (totalPurchase) totalPurchase.innerHTML = `<span class="currency-symbol">${currencySymbol}</span> ` + (total % 1 === 0 ? total.toLocaleString(undefined, {maximumFractionDigits:0}) : total.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2}));
    const totalPayment = document.getElementById('total-payment');
    let shipping = isID ? 15000 : 3;
    const totalWithShipping = total + shipping;
    if (totalPayment) totalPayment.innerHTML = `<span class="currency-symbol">${currencySymbol}</span> ` + (totalWithShipping % 1 === 0 ? totalWithShipping.toLocaleString(undefined, {maximumFractionDigits:0}) : totalWithShipping.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2}));
  }
  // Inisialisasi awal
  updateCurrencySymbol();
  // Toggle address fields by country & update currency
  const indoGroup = document.getElementById('address-indonesia-group');
  const intlGroup = document.getElementById('address-international-group');
  const countrySelect = document.getElementById('recipient-country');
  if (countrySelect) {
    countrySelect.addEventListener('change', function() {
      if (this.value === 'ID') {
        indoGroup.classList.remove('hidden');
        intlGroup.classList.add('hidden');
      } else if (this.value === 'INTL') {
        indoGroup.classList.add('hidden');
        intlGroup.classList.remove('hidden');
      } else {
        indoGroup.classList.add('hidden');
        intlGroup.classList.add('hidden');
      }
      updateCurrencySymbol();
    });
    // Set default simbol saat load
    updateCurrencySymbol();
  }
  // Validasi form saat klik Checkout
  const checkoutBtn = document.getElementById('checkout-btn');
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', function(e) {
      let valid = true;
      // Phone
      const phone = document.getElementById('recipient-phone');
      const phoneError = document.getElementById('phone-error');
      if (!phone.value.trim()) {
        phone.classList.add('border-red-500');
        phoneError.classList.remove('hidden');
        valid = false;
      } else {
        phone.classList.remove('border-red-500');
        phoneError.classList.add('hidden');
      }
      // Address (Indonesia)
      if (countrySelect.value === 'ID') {
        const address = document.getElementById('recipient-address');
        const addressError = document.getElementById('address-error');
        if (!address.value || address.value === '') {
          address.classList.add('border-red-500');
          addressError.classList.remove('hidden');
          valid = false;
        } else {
          address.classList.remove('border-red-500');
          addressError.classList.add('hidden');
        }
      }
      // Address (International)
      if (countrySelect.value === 'INTL') {
        const intlCountry = document.getElementById('recipient-country-list');
        const intlCity = document.getElementById('recipient-city');
        if (!intlCountry.value || intlCountry.value === '') {
          intlCountry.classList.add('border-red-500');
          valid = false;
        } else {
          intlCountry.classList.remove('border-red-500');
        }
        if (!intlCity.value.trim()) {
          intlCity.classList.add('border-red-500');
          valid = false;
        } else {
          intlCity.classList.remove('border-red-500');
        }
      }
      // Full Address
      const fulladdress = document.getElementById('recipient-fulladdress');
      const fulladdressError = document.getElementById('fulladdress-error');
      if (!fulladdress.value.trim()) {
        fulladdress.classList.add('border-red-500');
        fulladdressError.classList.remove('hidden');
        valid = false;
      } else {
        fulladdress.classList.remove('border-red-500');
        fulladdressError.classList.add('hidden');
      }
      if (!valid) {
        e.preventDefault();
        return;
      }
      // Jika valid, redirect
      window.location.href = '/producttransaction';
    });
  }
  // --- RAJAONGKIR ADDRESS & ONGKIR ---
  let provincesData = [];
  function loadProvincesAndCities() {
    fetch('/api/provinces')
      .then(res => {
        if (!res.ok) throw new Error('Gagal fetch provinces');
        return res.json();
      })
      .then(data => {
        provincesData = data.rajaongkir.results;
        if (!provincesData || provincesData.length === 0) {
          console.error('Provinces kosong:', data);
          alert('Gagal memuat data provinsi.');
          return;
        }
        // Isi dropdown provinsi (opsional, jika ingin tampilkan select provinsi)
        // Ambil provinsi pertama sebagai default
        const firstProvinceId = provincesData[0].province_id;
        loadCities(firstProvinceId);
        document.getElementById('province_id').value = firstProvinceId;
        document.getElementById('province_name').value = provincesData[0].province;
      })
      .catch(err => {
        console.error('Error fetch provinces:', err);
        alert('Gagal memuat data provinsi. Cek koneksi atau hubungi admin.');
      });
  }
  function loadCities(provinceId) {
    fetch('/api/cities', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({province_id: provinceId})
    })
    .then(res => {
      if (!res.ok) throw new Error('Gagal fetch cities');
      return res.json();
    })
    .then(data => {
      if (!data.rajaongkir || !data.rajaongkir.results) {
        console.error('Cities kosong:', data);
        alert('Gagal memuat data kota.');
        return;
      }
      let cityOptions = '<option value="">Pilih Kabupaten/Kota</option>';
      data.rajaongkir.results.forEach(city => {
        cityOptions += `<option value="${city.city_id}" data-city-name="${city.type} ${city.city_name}" data-province-id="${city.province_id}" data-province-name="${city.province}">${city.type} ${city.city_name}, ${city.province}</option>`;
      });
      document.getElementById('city_id').innerHTML = cityOptions;
    })
    .catch(err => {
      console.error('Error fetch cities:', err);
      alert('Gagal memuat data kota. Cek koneksi atau hubungi admin.');
    });
  }
  // Event listeners
  if (document.getElementById('city_id')) {
    loadProvincesAndCities();
    document.getElementById('city_id').addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      document.getElementById('city_name').value = selectedOption.getAttribute('data-city-name') || '';
      document.getElementById('province_id').value = selectedOption.getAttribute('data-province-id') || '';
      document.getElementById('province_name').value = selectedOption.getAttribute('data-province-name') || '';
      getOngkir();
    });
  }
  // --- PROVINSI & KOTA (DARI RAJAONGKIR) ---
  let rajaongkirProvinces = [];
  function loadProvinces() {
    fetch('/api/provinces')
      .then(response => response.json())
      .then(data => {
        rajaongkirProvinces = data.rajaongkir.results;
        let options = '<option value="">Pilih Provinsi</option>';
        rajaongkirProvinces.forEach(province => {
          options += `<option value="${province.province_id}">${province.province}</option>`;
        });
        document.getElementById('province_id_select').innerHTML = options;
      });
  }
  function loadCitiesByProvince(provinceId) {
    fetch('/api/cities', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({province_id: provinceId})
    })
    .then(response => response.json())
    .then(data => {
      let options = '<option value="">Pilih Kabupaten/Kota</option>';
      data.rajaongkir.results.forEach(city => {
        options += `<option value="${city.city_id}" data-city-name="${city.type} ${city.city_name}" data-province-id="${city.province_id}" data-province-name="${city.province}">${city.type} ${city.city_name}, ${city.province}</option>`;
      });
      document.getElementById('city_id').innerHTML = options;
    });
  }
  // Init
  loadProvinces();
  // Province change event
  document.getElementById('province_id_select').addEventListener('change', function() {
    const provinceId = this.value;
    if (provinceId) {
      loadCitiesByProvince(provinceId);
      const selectedProvince = rajaongkirProvinces.find(prov => prov.province_id === provinceId);
      document.getElementById('province_name').value = selectedProvince ? selectedProvince.province : '';
    } else {
      document.getElementById('city_id').innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
      document.getElementById('province_name').value = '';
    }
    getOngkir();
  });
  // ...existing code...
});
</script>

