<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>NaZMaLogy Product Content</title>
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

    <section class="bg-white rounded-xl p-6 max-w-md w-full flex flex-col justify-between">
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
        <div class="flex items-center justify-between text-sm border-t border-gray-300 pt-2 mb-2">
          <span class="font-semibold">Qty:</span>
          <div class="flex items-center space-x-4 select-none">
            <button id="qty-decrease" aria-label="Decrease quantity" class="text-lg font-bold text-gray-700 hover:text-orange-500" type="button">−</button>
            <span id="qty-value" class="font-semibold">1</span>
            <button id="qty-increase" aria-label="Increase quantity" class="text-lg font-bold text-gray-700 hover:text-orange-500" type="button">+</button>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            let qty = 1;
            const qtyValue = document.getElementById('qty-value');
            document.getElementById('qty-increase').onclick = function() {
              qty++;
              qtyValue.textContent = qty;
            };
            document.getElementById('qty-decrease').onclick = function() {
              if (qty > 1) {
                qty--;
                qtyValue.textContent = qty;
              }
            };
          });
        </script>

        <div class="flex items-center justify-between text-sm border-t border-gray-300 pt-2 mb-6">
          <span class="font-semibold">Price:</span>
          <span class="font-semibold">${{ $product->productpricedollar }}</span>
        </div>
      </div>
      <div class="flex space-x-4">
        <a href="/productcart">
          <button class="border border-orange-500 text-orange-500 rounded-full px-6 py-2 font-semibold hover:bg-orange-50 transition" type="button">Add to cart</button>
        </a>
        <a href="/productdata">
          <button class="bg-gradient-to-r from-orange-400 to-orange-500 text-white rounded-full px-6 py-2 font-semibold hover:brightness-110 transition" type="button">Buy Now</button>
        </a>
      </div>
    </section>
  </main>

  <section class="container description-section">
    <h3 class="description-title">Description</h3>
    <div class="bg-white rounded-xl p-6 mb-4 shadow">
      <p class="mb-2"><span class="font-semibold">Product Name:</span> {{ $product->productname }}</p>
      <p class="mb-2"><span class="font-semibold">Category:</span> {{ $product->catalog->productcatalogname ?? '-' }}</p>
      <p class="mb-2"><span class="font-semibold">Region:</span> {{ $product->region->productregionsname ?? '-' }}</p>
      <p class="mb-2"><span class="font-semibold">Price (Rp):</span> Rp {{ number_format($product->productpricerupiah,0,',','.') }}</p>
      <p class="mb-2"><span class="font-semibold">Price ($):</span> ${{ $product->productpricedollar }}</p>
      <p class="mb-2"><span class="font-semibold">Weight (kg):</span> {{ $product->productweight }}</p>
      <p class="mb-2"><span class="font-semibold">Stock:</span> {{ $product->productstock }}</p>
      <p class="mb-2"><span class="font-semibold">Description:</span> {{ $product->productdescription }}</p>
    </div>
    <p class="description-text"><span class="emoji">📜</span> TAS WARNA NUSANTARA⚖️📝</p>
    <p class="description-text">
      Elevate your style with this chic small handbag... (truncated for brevity)
    </p>
    <p class="description-text">
      <span class="emoji">📞</span> Daftar Sekarang di NaZMa Office!<br/>
      WA: 0823-2410-2401 (Meylin) | 0813-9211-3276 (Wiwit AB)<br/>
      <span class="emoji">📧</span> Email: itmcnazma@gmail.com<br/>
      <span class="emoji">🌐</span> Web: www.nazmaoffice.com<br/>
      <span class="emoji">📍</span> Alamat: Jl. Selokan Mataram No. 16, Pogung Dalangan, Sleman, Yogyakarta<br/>
      <span class="emoji">📱</span> IG: @nazma_office | FB, YouTube, LinkedIn: NaZMa Office
    </p>
    <p class="description-tags">
      <a href="#">#PelatihanKontrak</a>
      <a href="#">#ContractDevelopment</a>
      <a href="#">#NaZMaOffice</a>
      <a href="#">#LegalTraining</a>
      <a href="#">#WorkshopKontrak</a>
      <a href="#">#KontrakBisnis</a>
      <a href="#">#NegosiasiBisnis</a>
      <a href="#">#HukumKontrak</a>
      <a href="#">#BusinessLaw</a>
      <a href="#">#Training</a>
      <a href="#">Yogyakarta</a>
    </p>
  </section>
</body>
</html>