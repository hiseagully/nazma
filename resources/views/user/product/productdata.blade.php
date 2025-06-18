<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>
   NaZMaLogy Product Data
  </title>
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
    @php
        $user = Auth::user();
        $province = $user->district_name ? trim(explode(',', $user->district_name)[0]) : '';
        $city = $user->district_name ? trim(explode(',', $user->district_name)[1] ?? '') : '';
    @endphp
    <form aria-labelledby="trainee-data-title" class="trainee-data-form" id="trainee-form">
     <h2 id="trainee-data-title" class="form-title">
      Recipient Data
     </h2>
     <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input bg-gray-100" value="{{ $user->user_email ?? $user->email }}" readonly>
              </div>
     <div class="form-group">
      <label class="form-label">Name</label>
      <input type="text" class="form-input bg-gray-100" value="{{ $user->user_name ?? $user->name }}" readonly>
     </div>
     <div class="form-group">
      <label class="form-label" for="recipient-phone">
       Phone Number
      </label>
      <input type="tel" class="form-input bg-gray-100" id="recipient-phone" name="recipient_phone" value="{{ $user->user_phone }}" readonly>
     </div>
     <div class="form-group">
      <label class="form-label" for="recipient-country">Country</label>
      <select class="form-input text-sm font-normal w-full border border-gray-300 rounded-md py-3 px-4 placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="recipient-country" name="recipient_country" required>
        <option value="">Select Country</option>
        <option value="ID" data-country-name="Indonesia" {{ $user->country_code == 'ID' ? 'selected' : '' }}>Indonesia</option>
        <option value="INTL" data-country-name="International" {{ $user->country_code && $user->country_code != 'ID' ? 'selected' : '' }}>International</option>
      </select>
     </div>
     <div class="form-group" id="address-indonesia-group">
      <label class="form-label">Province</label>
      <input type="text" class="form-input bg-gray-100" value="{{ $province }}" readonly>
      <label class="form-label mt-2">City</label>
      <input type="text" class="form-input bg-gray-100" value="{{ $city }}" readonly>
     </div>
     <div class="form-group">
      <label class="form-label" for="recipient-fulladdress">
       Full Address
      </label>
      <textarea class="form-textarea bg-gray-100" id="recipient-fulladdress" name="recipient_fulladdress" readonly>{{ $user->full_address }}</textarea>
     </div>
     <div class="mt-4 p-3 bg-gray-50 border border-gray-200 rounded">
      <div class="mb-2 font-semibold text-sm text-gray-700">Sender Address (Admin)</div>
      <div class="text-xs text-gray-700">
        @if(isset($admin) && $admin)
          {{ $admin->user_name ?? '-' }}<br>
          {{ $admin->full_address ?? '-' }}<br>
          {{ $admin->district_name ?? '-' }}<br>
          {{ $admin->country_name ?? '-' }}
        @else
          <span class="text-gray-400">Data admin tidak tersedia.</span>
        @endif
      </div>
      <div class="mt-3 mb-2 font-semibold text-sm text-gray-700">Recipient Address (You)</div>
      <div class="text-xs text-gray-700">
        {{ $user->user_name ?? '-' }}<br>
        {{ $user->full_address ?? '-' }}<br>
        {{ $user->district_name ?? '-' }}<br>
        {{ $user->country_name ?? '-' }}
      </div>
     </div>
    </form>
    
    <section aria-labelledby="payment-title"class="bg-white rounded-xl p-6 w-full max-w-md shadow-md flex flex-col justify-between">
      <h2 class="font-bold text-lg mb-6" id="payment-title">Payment</h2>
      <!-- Produk dinamis dari localStorage -->
      <div id="dynamic-product-list" class="space-y-4 mb-8">
        @if(isset($product))
          @php
            $qtyVal = isset($qty) ? (int)$qty : 1;
            $subtotal = $product->productpricedollar * $qtyVal;
            $totalPurchase = $subtotal;
          @endphp
          <div class='flex items-center gap-3 py-2'>
            <img alt='{{ $product->productname }}' src='{{ count($product->images) ? asset('storage/' . $product->images->first()->image_path) : asset('images/noimage.png') }}' class='w-20 h-20 rounded-lg object-cover flex-shrink-0 border border-gray-200' width='80' height='80'/>
            <div class='flex-1 min-w-0 flex flex-col justify-center'>
              <div class='flex items-center justify-between mb-0.5'>
                <span class='text-xs text-gray-500'>{{ $product->catalog->productcatalogname ?? '-' }}</span>
                <span class='text-xs text-gray-700'>Qty: <span class='font-semibold'>{{ $qtyVal }}</span></span>
              </div>
              <p class='font-semibold text-sm truncate mb-0.5' title='{{ $product->productname }}'>{{ $product->productname }}</p>
              <div class='flex items-center justify-between'>
                <span class='text-xs text-gray-500'>Price:</span>
                <span class='text-sm font-normal'>$ {{ $product->productpricedollar }}</span>
              </div>
              <div class='flex items-center justify-between mt-0.5'>
                <span class='text-xs text-gray-500'>Subtotal:</span>
                <span class='text-sm font-semibold'>$ {{ number_format($subtotal, 2) }}</span>
              </div>
            </div>
          </div>
        @elseif(isset($products) && $products->count())
          @php $totalPurchase = 0; @endphp
          @foreach($products as $prod)
            @php
              $qtyVal = isset($qtyMap[$prod->productid]) ? (int)$qtyMap[$prod->productid] : 1;
              $subtotal = $prod->productpricedollar * $qtyVal;
              $totalPurchase += $subtotal;
            @endphp
            <div class='flex items-center gap-3 py-2'>
              <img alt='{{ $prod->productname }}' src='{{ count($prod->images) ? asset('storage/' . $prod->images->first()->image_path) : asset('images/noimage.png') }}' class='w-20 h-20 rounded-lg object-cover flex-shrink-0 border border-gray-200' width='80' height='80'/>
              <div class='flex-1 min-w-0 flex flex-col justify-center'>
                <div class='flex items-center justify-between mb-0.5'>
                  <span class='text-xs text-gray-500'>{{ $prod->catalog->productcatalogname ?? '-' }}</span>
                  <span class='text-xs text-gray-700'>Qty: <span class='font-semibold'>{{ $qtyVal }}</span></span>
                </div>
                <p class='font-semibold text-sm truncate mb-0.5' title='{{ $prod->productname }}'>{{ $prod->productname }}</p>
                <div class='flex items-center justify-between'>
                  <span class='text-xs text-gray-500'>Price:</span>
                  <span class='text-sm font-normal'>$ {{ $prod->productpricedollar }}</span>
                </div>
                <div class='flex items-center justify-between mt-0.5'>
                  <span class='text-xs text-gray-500'>Subtotal:</span>
                  <span class='text-sm font-semibold'>$ {{ number_format($subtotal, 2) }}</span>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
      <div class="flex justify-between font-semibold text-sm">
        <span>Total Purchase:</span>
        <span id="total-purchase">$ {{ number_format(isset($totalPurchase) ? $totalPurchase : 0, 2) }}</span>
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
          <select aria-required="true" class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400" id="courier" name="courier" required>
            <option class="text-gray-300" value="" disabled selected>Choose Courier</option>
            <option value="jne">JNE</option>
            <option value="pos">POS Indonesia</option>
            <option value="tiki">TIKI</option>
          </select>
          <button type="button" id="check-shipping" class="mt-2 text-xs px-3 py-1 rounded bg-orange-400 text-white hover:bg-orange-500 focus:outline-none" style="font-size: 12px;">
            Check Shipping Cost
          </button>
          <div id="shipping-result" class="mt-2"></div>
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
  <script>
document.getElementById('check-shipping').addEventListener('click', function() {
    const origin = '{{ $admin_city_id ?? '' }}'; // city_id admin, dari backend
    const destination = '{{ $user->district_code ?? '' }}'; // city_id user login
    const weight_kg = {{ $total_weight_kg ?? 1 }}; // berat total dari backend (kg)
    const weight = weight_kg * 1000; // konversi ke gram
    const courier = document.getElementById('courier').value;

    if (!courier) {
        alert('Please select a courier!');
        return;
    }

    fetch('/api/check-shipping', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            origin: origin,
            destination: destination,
            weight: weight,
            courier: courier
        })
    })
    .then(res => res.json())
    .then(data => {
        let html = '';
        if (data.rajaongkir && data.rajaongkir.results.length > 0) {
            const services = data.rajaongkir.results[0].costs;
            html += '<label class="form-label">Shipping Options</label>';
            html += '<select name="shipping_service" class="form-input">';
            services.forEach(service => {
                const cost = service.cost[0].value;
                html += `<option value="${service.service}|${cost}">${service.service} - Rp${cost.toLocaleString()} (${service.description})</option>`;
            });
            html += '</select>';
        } else {
            html = '<div class="text-red-500">No shipping options found.</div>';
        }
        document.getElementById('shipping-result').innerHTML = html;
    })
    .catch(() => {
        document.getElementById('shipping-result').innerHTML = '<div class="text-red-500">Failed to get shipping cost.</div>';
    });
});
</script>
 </body>
</html>
