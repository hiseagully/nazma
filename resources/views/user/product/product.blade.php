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
   <div class="mb-4 flex items-center gap-2">
    <span id="search-loading" class="hidden text-orange-500"><i class="fas fa-spinner fa-spin"></i> Loading...</span>
   </div>
   <div id="product-list" aria-label="Product list" class="grid grid-cols-2 sm:grid-cols-5 gap-6">
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
        <p class="font-bold text-sm mb-0.5 line-clamp-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
          {{ $product->productname }}
        </p>
        <p class="font-semibold text-sm mb-0.5">$
          {{ $product->productpricedollar }}
        </p>
      </article>
    </a>
    @endforeach
   </div>
   <div id="search-empty" class="hidden text-center text-gray-400 mt-8">Produk tidak ditemukan.</div>
  </main>
  <x-footer></x-footer>
  @php
    $jsonProducts = $products->map(function($p) {
        return [
            'productid' => $p->productid,
            'productname' => $p->productname,
            'productpricedollar' => $p->productpricedollar,
            'thumbnail' => optional($p->images->where('is_thumbnail', true)->first())->image_path
                ? asset('storage/' . $p->images->where('is_thumbnail', true)->first()->image_path)
                : asset('images/noimage.png'),
            'catalogname' => $p->catalog->productcatalogname ?? '-',
        ];
    })->values()->toArray();
@endphp
  <script>
    const allProducts = @json($jsonProducts);
    const searchInput = document.getElementById('search-input');
    const productList = document.getElementById('product-list');
    const searchLoading = document.getElementById('search-loading');
    const searchEmpty = document.getElementById('search-empty');
    let lastKeyword = '';
    let lastRequest = null;

    searchInput.addEventListener('input', function() {
      const keyword = this.value.trim();
      if (keyword === lastKeyword) return;
      lastKeyword = keyword;
      if (lastRequest) lastRequest.abort && lastRequest.abort();
      searchLoading.classList.remove('hidden');
      // Jika kosong, tampilkan semua produk urutan awal
      if (!keyword) {
        let html = '';
        allProducts.forEach(product => {
          html += `
          <a href="/productdetail/${product.productid}">
            <article class="bg-white rounded-xl p-4 flex flex-col items-start select-none" style="font-family: 'Inter', sans-serif">
              <img alt="${product.productname}" class="rounded-lg mb-3" height="200" loading="lazy" src="${product.thumbnail ? product.thumbnail : '/images/noimage.png'}" width="200"/>
              <div class="flex justify-between items-center w-full">
                <div class="text-left text-xs text-gray-400 mb-0.5">
                  ${product.catalogname ?? '-'}
                </div>
                <div class="flex justify-end items-center space-x-1 text-yellow-400 text-xs text-right">
                  <i class="fas fa-star"></i>
                  <span>5.0</span>
                </div>
              </div>
              <p class="font-bold text-sm mb-0.5 line-clamp-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                ${product.productname}
              </p>
              <p class="font-semibold text-sm mb-0.5">$
                ${product.productpricedollar}
              </p>
            </article>
          </a>
          `;
        });
        productList.innerHTML = html;
        searchLoading.classList.add('hidden');
        searchEmpty.classList.add('hidden');
        return;
      }
      fetch(`/product/search?keyword=${encodeURIComponent(keyword)}`)
        .then(response => response.json())
        .then(data => {
          searchLoading.classList.add('hidden');
          let html = '';
          if (data.length === 0) {
            productList.innerHTML = '';
            searchEmpty.classList.remove('hidden');
            return;
          }
          searchEmpty.classList.add('hidden');
          // Urutkan: yang match keyword di atas, sisanya di bawah
          const keywordLower = keyword.toLowerCase();
          const match = allProducts.filter(p => p.productname.toLowerCase().includes(keywordLower));
          const notMatch = allProducts.filter(p => !p.productname.toLowerCase().includes(keywordLower));
          match.forEach(product => {
            html += `
            <a href="/productdetail/${product.productid}">
              <article class="bg-white rounded-xl p-4 flex flex-col items-start select-none" style="font-family: 'Inter', sans-serif">
                <img alt="${product.productname}" class="rounded-lg mb-3" height="200" loading="lazy" src="${product.thumbnail ? product.thumbnail : '/images/noimage.png'}" width="200"/>
                <div class="flex justify-between items-center w-full">
                  <div class="text-left text-xs text-gray-400 mb-0.5">
                    ${product.catalogname ?? '-'}
                  </div>
                  <div class="flex justify-end items-center space-x-1 text-yellow-400 text-xs text-right">
                    <i class="fas fa-star"></i>
                    <span>5.0</span>
                  </div>
                </div>
                <p class="font-bold text-sm mb-0.5 line-clamp-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                  ${highlightKeyword(product.productname, keyword)}
                </p>
                <p class="font-semibold text-sm mb-0.5">$
                  ${product.productpricedollar}
                </p>
              </article>
            </a>
            `;
          });
          notMatch.forEach(product => {
            html += `
            <a href="/productdetail/${product.productid}">
              <article class="bg-white rounded-xl p-4 flex flex-col items-start select-none" style="font-family: 'Inter', sans-serif">
                <img alt="${product.productname}" class="rounded-lg mb-3" height="200" loading="lazy" src="${product.thumbnail ? product.thumbnail : '/images/noimage.png'}" width="200"/>
                <div class="flex justify-between items-center w-full">
                  <div class="text-left text-xs text-gray-400 mb-0.5">
                    ${product.catalogname ?? '-'}
                  </div>
                  <div class="flex justify-end items-center space-x-1 text-yellow-400 text-xs text-right">
                    <i class="fas fa-star"></i>
                    <span>5.0</span>
                  </div>
                </div>
                <p class="font-bold text-sm mb-0.5 line-clamp-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                  ${highlightKeyword(product.productname, keyword)}
                </p>
                <p class="font-semibold text-sm mb-0.5">$
                  ${product.productpricedollar}
                </p>
              </article>
            </a>
            `;
          });
          productList.innerHTML = html;
          productList.scrollIntoView({ behavior: 'smooth', block: 'start' });
        })
        .catch(() => {
          searchLoading.classList.add('hidden');
          productList.innerHTML = '';
          searchEmpty.classList.remove('hidden');
        });
    });
    function highlightKeyword(text, keyword) {
      if (!keyword) return text;
      const re = new RegExp(`(${keyword.replace(/[.*+?^${}()|[\\]\\]/g, '\\$&')})`, 'gi');
      return text.replace(re, '<span class="bg-yellow-200">$1</span>');
    }
  </script>
</body>
</html>