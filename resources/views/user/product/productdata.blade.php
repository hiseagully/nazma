<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NaZMaLogy Product Data
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>
  <x-trainingsearchbox></x-trainingsearchbox>
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
      <label class="form-label" for="recipient-address">
       Address (Indonesia)
      </label>
      <select aria-required="true" class="form-input text-sm font-normal w-full border border-gray-300 rounded-md py-3 px-4 placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="recipient-address" name="recipient_address" required>
        <option value="" disabled selected>Select Province/City/District</option>
        <!-- Opsi alamat dari API akan diisi via JS -->
      </select>
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
            <option>JNE</option>
            <option>POS Indonesia</option>
            <option>TIKI</option>
          </select>
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
        // Default: render harga dollar (productpricedollar) saat load awal
        let unitPrice = item.productpricedollar || 0;
        // Jika country Indonesia baru pakai productpricerupiah
        if (isID) {
          unitPrice = item.productpricerupiah || item.productpricedollar || 0;
        }
        unitPrice = parseFloat(unitPrice) || 0;
        const qty = parseFloat(item.qty || 1);
        const subtotal = unitPrice * qty;
        paymentList.innerHTML += `
          <div class="flex gap-4 items-center py-3">
            <img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0"/>
            <div class="flex-1 min-w-0 flex flex-col">
              <span class="text-xs text-gray-500">${item.category}</span>
              <span class="font-semibold text-sm truncate whitespace-nowrap overflow-hidden block" title="${item.name}">${item.name}</span>
              <span class="text-xs text-gray-600">Qty: ${item.qty}</span>
            </div>
            <div class="flex flex-col items-end min-w-[90px]">
              <span class="font-semibold text-sm whitespace-nowrap"><span class="currency-symbol">${currencySymbol}</span> ${unitPrice.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</span>
              <span class="text-xs text-gray-500 whitespace-nowrap">Subtotal: <span class="currency-symbol">${currencySymbol}</span> ${subtotal.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</span>
            </div>
          </div>
          <hr class="border-gray-300 m-0" />
        `;
        total += subtotal;
      });
    }
    // Update total purchase dan total payment
    const totalPurchase = document.getElementById('total-purchase');
    if (totalPurchase) totalPurchase.innerHTML = `<span class="currency-symbol">${currencySymbol}</span> ` + total.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
    const totalPayment = document.getElementById('total-payment');
    // Contoh ongkir: 3 USD atau 15000 IDR
    let shipping = isID ? 15000 : 3;
    if (totalPayment) totalPayment.innerHTML = `<span class="currency-symbol">${currencySymbol}</span> ` + (total+shipping).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
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
});
</script>

