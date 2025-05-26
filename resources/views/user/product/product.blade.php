<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>NaZMaLogy Landing Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{ asset('css/product/product.css') }}">
</head>
<body>
  <x-header></x-header>
  <x-productsearchbox></x-productsearchbox>
  <!-- Product heading -->
  <div class="max-w-6xl mx-auto w-full px-6 mt-8">
   <h2 class="text-[#f58220] font-bold text-lg select-none" style="font-family: 'Inter', sans-serif">
    Product
   </h2>
  </div>
  <!-- Product grid -->
  <main class="max-w-6xl mx-auto w-full px-6 mt-4 flex-grow">
   <div aria-label="Product list" class="grid grid-cols-2 sm:grid-cols-5 gap-6">
    @foreach($products as $product)
    <a href="/productdetail/{{ $product->productid }}">
      <article class="bg-white rounded-xl p-4 flex flex-col items-start select-none" style="font-family: 'Inter', sans-serif">
        <img alt="{{ $product->productname }}" class="rounded-lg mb-3" height="200" loading="lazy" src="{{ optional($product->images->where('is_thumbnail', true)->first())->image_path ? asset('storage/' . $product->images->where('is_thumbnail', true)->first()->image_path) : asset('images/noimage.png') }}" width="200"/>
        <div class="flex justify-between items-center w-full">
          <div class="text-left text-xs text-gray-400 mb-0.5">
            {{ $product->catalog->productcatalogname ?? '-' }}
          </div>
          <div class="flex justify-end items-center space-x-1 text-yellow-400 text-xs text-right">
            <i class="fas fa-star"></i>
            <span>5.0</span>
          </div>
        </div>
        <p class="font-bold text-sm mb-0.5">
          {{ $product->productname }}
        </p>
        <p class="font-semibold text-sm mb-0.5">$
          {{ $product->productpricedollar }}
      </article>
    </a>
    @endforeach
   </div>
  </main>
  <x-footer></x-footer>
</body>
</html>