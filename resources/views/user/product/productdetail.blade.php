<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>NaZMaLogy Product Detail</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
  <x-header></x-header>
  <x-productsearchbox></x-productsearchbox>
  <link rel="stylesheet" href="{{ asset('css/product/productdetail.css') }}">
</head>
<body>
  <main class="container main-grid">
    <div class="card-left">
      <div id="carousel" class="relative w-full max-w-xl mx-auto">
        @php
          $images = $product->images->all();
          usort($images, function($a, $b) {
            return ($b->is_thumbnail <=> $a->is_thumbnail);
          });
        @endphp
        <img id="carousel-image" alt="Product Image" class="card-image rounded-xl object-cover" height="400" src="{{ count($images) ? asset('storage/' . $images[0]->image_path) : asset('images/noimage.png') }}" width="600"/>
        @if(count($images) > 1)
        <button id="carousel-next" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-30 rounded-full p-2 hover:bg-orange-100 transition border border-gray-200 shadow-none" style="backdrop-filter: blur(2px);">
          <i class="fas fa-chevron-right text-xl text-white"></i>
        </button>
        <button id="carousel-prev" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-30 rounded-full p-2 hover:bg-orange-100 transition border border-gray-200 shadow-none" style="backdrop-filter: blur(2px);">
          <i class="fas fa-chevron-left text-xl text-white"></i>
        </button>
        @endif
        <div class="flex justify-center items-center gap-1 absolute left-1/2 -translate-x-1/2 bottom-6 z-10">
          @foreach($images as $img)
            <span class="carousel-dot inline-block w-2 h-2 rounded-full bg-gray-300 cursor-pointer" data-index="{{ $loop->index }}"></span>
          @endforeach
        </div>
      </div>
    </div>

    <section class="bg-white rounded-xl p-6 max-w-md w-full flex flex-col justify-between self-start" style="height:auto; min-height:0;">
      <div>
        <div class="flex justify-between items-center w-full">
          <div class="text-left text-xs text-gray-400 mb-0.5">
            {{ $product->catalog->productcatalogname ?? '-' }}
          </div>
          <div class="flex justify-end items-center space-x-1 text-yellow-400 text-xs text-right">
            <i class="fas fa-star"></i>
            <span>5.0</span>
          </div>
        </div>
        <h2 class="font-bold text-lg mb-1">
          {{ $product->productname }}
        </h2>
        <p class="font-semibold text-base mb-4">
          ${{ $product->productpricedollar }}
        </p>
        <div class="flex items-center justify-between text-sm pt-2 mb-2">
          <span class="font-semibold">Qty:</span>
          <div class="flex items-center space-x-4 select-none">
            <button id="qty-decrease" aria-label="Decrease quantity" class="text-lg font-bold text-gray-700 hover:text-orange-500" type="button">−</button>
            <span id="qty-value" class="font-semibold">1</span>
            <button id="qty-increase" aria-label="Increase quantity" class="text-lg font-bold text-gray-700 hover:text-orange-500" type="button">+</button>
          </div>
        </div>
        <div class="flex items-center justify-between text-sm border-t border-gray-300 pt-2 mb-6">
          <span class="font-semibold">Price:</span>
          <span id="total-price" class="font-semibold">${{ $product->productpricedollar }}</span>
        </div>
      </div>
      <div class="flex gap-3 w-full mt-2">
        <form action="{{ route('cart.add', ['productid' => $product->productid]) }}" method="POST" class="w-full">
          @csrf
          <input type="hidden" name="quantity" id="cart-qty" value="1">
          <button class="w-full border border-orange-500 text-orange-500 rounded-full px-6 py-2 font-semibold hover:bg-orange-50 transition" type="submit">
            Add to cart
          </button>
        </form>
        <form id="buy-now-form" action="{{ route('productcollection.show', ['productcollection' => $product->productid]) }}" method="GET" class="w-full">
          <input type="hidden" name="qty" id="buy-now-qty" value="1">
          <button id="buy-now-btn" class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white rounded-full px-6 py-2 font-semibold hover:brightness-110 transition" type="submit">Buy Now</button>
        </form>
      </div>
    </section>
  </main>
  <section class="container description-section">
    <h3 class="description-title">{{ $product->productname }}</h3>
    <div class="">
      <p class="mb-2"><span class="font-semibold">Spesification</span></p>
      <table class="w-full mb-4 text-sm">
        <tbody>
          <tr>
            <td class="text-gray-400 font-normal py-1 pr-1 w-32 whitespace-nowrap">Category</td>
            <td class="text-gray-400 font-normal py-1 w-2 px-0">:</td>
            <td class="py-1">{{ $product->catalog->productcatalogname ?? '-' }}</td>
          </tr>
          <tr>
            <td class="text-gray-400 font-normal py-1 pr-1 w-32 whitespace-nowrap">Product Origin</td>
            <td class="text-gray-400 font-normal py-1 w-2 px-0">:</td>
            <td class="py-1">{{ $product->region->productregionsname ?? '-' }}</td>
          </tr>
          <tr>
            <td class="text-gray-400 font-normal py-1 pr-1 w-32 whitespace-nowrap">Price (Rp)</td>
            <td class="text-gray-400 font-normal py-1 w-2 px-0">:</td>
            <td class="py-1">Rp {{ number_format($product->productpricerupiah,0,',','.') }}</td>
          </tr>
          <tr>
            <td class="text-gray-400 font-normal py-1 pr-1 w-32 whitespace-nowrap">Weight</td>
            <td class="text-gray-400 font-normal py-1 w-2 px-0">:</td>
            <td class="py-1">{{ $product->productweight }} kg</td>
          </tr>
          <tr>
            <td class="text-gray-400 font-normal py-1 pr-1 w-32 whitespace-nowrap">Stock</td>
            <td class="text-gray-400 font-normal py-1 w-2 px-0">:</td>
            <td class="py-1">{{ $product->productstock }}</td>
          </tr>
        </tbody>
      </table>
      <p class="mb-2"><span class="font-semibold">Description</span><br>
      <p class="py-1 text-sm" style="text-align: justify;">
        {{ $product->productdescription }}
      </p>
    </div>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let qty = 1;
      const price = {{ $product->productpricedollar }};
      const priceRupiah = {{ $product->productpricerupiah }};
      const qtyValue = document.getElementById('qty-value');
      const totalPrice = document.getElementById('total-price');
      const cartQtyInput = document.getElementById('cart-qty');
      const buyNowForm = document.getElementById('buy-now-form');
      const buyNowQtyInput = document.getElementById('buy-now-qty');
      document.getElementById('qty-increase').onclick = function() {
        qty++;
        qtyValue.textContent = qty;
        totalPrice.textContent = '$' + (qty * price).toLocaleString();
        cartQtyInput.value = qty;
        buyNowQtyInput.value = qty;
      };
      document.getElementById('qty-decrease').onclick = function() {
        if (qty > 1) {
          qty--;
          qtyValue.textContent = qty;
          totalPrice.textContent = '$' + (qty * price).toLocaleString();
          cartQtyInput.value = qty;
          buyNowQtyInput.value = qty;
        }
      };

      // --- Carousel Logic ---
      const images = [
        @foreach($images as $img)
          '{{ asset('storage/' . $img->image_path) }}',
        @endforeach
      ];
      let current = 0;
      const carouselImage = document.getElementById('carousel-image');
      const dots = document.querySelectorAll('.carousel-dot');
      const nextBtn = document.getElementById('carousel-next');
      const prevBtn = document.getElementById('carousel-prev');

      function updateCarousel(idx) {
        if (!images.length) return;
        current = idx;
        carouselImage.src = images[current];
        dots.forEach((dot, i) => {
          dot.style.background = i === current ? '#fb923c' : '#d1d5db';
        });
      }
      if (dots.length) {
        dots.forEach((dot, i) => {
          dot.onclick = () => updateCarousel(i);
        });
      }
      if (nextBtn) {
        nextBtn.onclick = function() {
          updateCarousel((current + 1) % images.length);
        };
      }
      if (prevBtn) {
        prevBtn.onclick = function() {
          updateCarousel((current - 1 + images.length) % images.length);
        };
      }
      // Set initial active dot
      updateCarousel(0);
    });
  </script>
</body>
  <x-footer></x-footer>
</html>