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
    
    <section aria-labelledby="payment-title"class="bg-white rounded-xl p-6 w-full max-w-md shadow-md flex flex-col justify-between">
      <h2 class="font-bold text-lg mb-6" id="payment-title">Payment</h2>
      <!-- Produk dinamis dari localStorage -->
      <div id="dynamic-product-list" class="space-y-4 mb-8"></div>
      <script>
      document.addEventListener('DOMContentLoaded', function() {
        const productList = document.getElementById('dynamic-product-list');
        let total = 0;
        // Ambil data dari localStorage (checkoutProducts) atau fallback ke selectedCartItems
        let products = JSON.parse(localStorage.getItem('checkoutProducts') || '[]');
        if (!products.length) {
          products = JSON.parse(localStorage.getItem('selectedCartItems') || '[]');
        }
        if (products.length === 0) {
          productList.innerHTML = '<div class="text-gray-500 text-center">Tidak ada produk yang dipilih.</div>';
        } else {
          productList.innerHTML = '';
          products.forEach(item => {
            const subtotal = (item.qty || 1) * (item.price || item.productpricedollar || 0);
            total += subtotal;
            productList.innerHTML += `
              <div class='flex items-center gap-3 py-2'>
                <img alt='${item.name}' src='${item.image}' class='w-20 h-20 rounded-lg object-cover flex-shrink-0 border border-gray-200' width='80' height='80'/>
                <div class='flex-1 min-w-0 flex flex-col justify-center'>
                  <div class='flex items-center justify-between mb-0.5'>
                    <span class='text-xs text-gray-500'>${item.category || '-'}</span>
                    <span class='text-xs text-gray-700'>Qty: <span class='font-semibold'>${item.qty}</span></span>
                  </div>
                  <p class='font-semibold text-sm truncate mb-0.5' title='${item.name}'>${item.name}</p>
                  <div class='flex items-center justify-between'>
                    <span class='text-xs text-gray-500'>Price:</span>
                    <span class='text-sm font-normal'>$ ${(item.price || item.productpricedollar || 0)}</span>
                  </div>
                  <div class='flex items-center justify-between mt-0.5'>
                    <span class='text-xs text-gray-500'>Subtotal:</span>
                    <span class='text-sm font-semibold'>$ ${subtotal}</span>
                  </div>
                </div>
              </div>
              <hr class='border-gray-200'/>
            `;
          });
        }
        // Update total purchase
        const totalPurchase = document.getElementById('total-purchase');
        if (totalPurchase) totalPurchase.textContent = `$ ${total}`;
      });
      </script>
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
      <button id="checkout-btn" class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold py-3 rounded-full hover:brightness-110 transition" type="button">Checkout</button>
    </section>
   </section>
  </main>
  <x-footer></x-footer>
 </body>
</html>
