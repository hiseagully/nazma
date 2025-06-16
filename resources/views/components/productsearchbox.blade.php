<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Search Component</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-[#F5F7FA]">
  <!-- Search Component -->
  <div class="flex justify-center mt-6">
    <div
      class="flex items-center bg-[#F7941D] rounded-full w-[75%] max-w-5xl px-6 py-2 space-x-4"
      role="search"
      aria-label="product search and actions"
    >
      <button
        aria-label="Filter"
        class="text-white text-lg flex items-center justify-center"
        type="button"
      >
        <i class="fas fa-filter"></i>
      </button>
      <input class="flex-grow rounded-full py-2 px-4 text-sm font-semibold placeholder-gray-400 focus:outline-none bg-white text-black" placeholder="Find the product you want" type="text" data-product-search id="search-input" autocomplete="off"/>
      <button
        aria-label="Search"
        class="text-[#F7941D] bg-white rounded-full p-2 hover:bg-gray-100"
        type="submit"
      >
        <i class="fas fa-search"></i>
      </button>
      <a
        href="/product"
        class="flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Product List"
      >
        <i class="fas fa-box"></i>
        <span>Products</span>
      </a>
      <a
        href="/producttransaction"
        class="flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Product Purchase"
      >
        <i class="fas fa-exchange-alt"></i>
        <span>Purchase</span>
      </a>
      <a
        href="/productcart"
        class="flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Product Cart"
      >
        <i class="fas fa-shopping-cart"></i>
        <span>Cart</span>
      </a>
    </button>
    </div>
  </div>
  <!-- Modal Filter -->
  <div id="filter-modal" class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center hidden">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6 relative">
      <button id="close-filter" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl" aria-label="Close">
        <i class="fas fa-times"></i>
      </button>
      <h2 class="text-black font-semibold text-lg mb-4">Filter</h2>
      <hr class="border-t border-gray-300 mb-4" />
      <form id="filter-form">
        <section class="mb-6">
          <label class="block text-black text-base font-normal mb-2">Location</label>
          <div id="filter-locations" class="grid grid-cols-3 gap-2">
            @php
              $regions = \App\Models\ProductRegionsMap::all()->sortBy('productregionsname')->values();
              $showCount = 6; // 2 row x 3 col
            @endphp
            @foreach($regions->take($showCount) as $region)
              <button type="button" data-value="{{ $region->productregionsname }}" class="w-full bg-gray-100 rounded-xl py-2 px-4 text-black font-normal text-sm filter-location">{{ $region->productregionsname }}</button>
            @endforeach
            @if($regions->count() > $showCount)
              <button id="see-all-location" type="button" class="w-full col-span-3 text-gray-400 font-normal text-sm py-2">See all &gt;</button>
            @endif
          </div>
          <div id="all-locations" class="grid grid-cols-3 gap-2 mt-2 hidden">
            @foreach($regions as $region)
              <button type="button" data-value="{{ $region->productregionsname }}" class="w-full bg-gray-100 rounded-xl py-2 px-4 text-black font-normal text-sm filter-location">{{ $region->productregionsname }}</button>
            @endforeach
            <button id="see-less-location" type="button" class="w-full col-span-3 text-gray-400 font-normal text-sm py-2">Show less &lt;</button>
          </div>
        </section>
        <section class="mb-6">
          <label class="block text-black text-base font-normal mb-2">Category</label>
          <div id="filter-categories" class="grid grid-cols-3 gap-2">
            @php
              $categories = \App\Models\ProductCatalog::all()->sortBy('productcatalogname')->values();
              $showCat = 6;
            @endphp
            @foreach($categories->take($showCat) as $cat)
              <button type="button" data-value="{{ $cat->productcatalogname }}" class="bg-gray-100 rounded-xl py-2 px-4 text-black font-normal text-sm filter-category">{{ $cat->productcatalogname }}</button>
            @endforeach
            @if($categories->count() > $showCat)
              <button id="see-all-category" type="button" class="w-full col-span-3 text-gray-400 font-normal text-sm py-2">See all &gt;</button>
            @endif
          </div>
          <div id="all-categories" class="grid grid-cols-3 gap-2 mt-2 hidden">
            @foreach($categories as $cat)
              <button type="button" data-value="{{ $cat->productcatalogname }}" class="bg-gray-100 rounded-xl py-2 px-4 text-black font-normal text-sm filter-category">{{ $cat->productcatalogname }}</button>
            @endforeach
            <button id="see-less-category" type="button" class="w-full col-span-3 text-gray-400 font-normal text-sm py-2">Show less &lt;</button>
          </div>
        </section>
        <div class="flex justify-end gap-4">
          <button type="reset" class="text-orange-500 font-semibold text-sm rounded-full border-2 border-orange-500 py-2 px-6 hover:bg-orange-50 transition-colors">Reset</button>
          <button type="submit" class="text-white font-semibold text-sm rounded-full py-2 px-6 bg-gradient-to-r from-orange-400 to-orange-600 hover:from-orange-500 hover:to-orange-700 transition-colors">Set</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    // Buka modal saat klik tombol filter
    document.querySelector('button[aria-label="Filter"]').onclick = function() {
      document.getElementById('filter-modal').classList.remove('hidden');
    };
    // Tutup modal saat klik tombol close
    document.getElementById('close-filter').onclick = function() {
      document.getElementById('filter-modal').classList.add('hidden');
    };
    // Tutup modal jika klik di luar box
    document.getElementById('filter-modal').onclick = function(e) {
      if (e.target === this) this.classList.add('hidden');
    };
    // See all logic for location
    const seeAllLocation = document.getElementById('see-all-location');
    const seeLessLocation = document.getElementById('see-less-location');
    if (seeAllLocation) {
      seeAllLocation.addEventListener('click', function() {
        document.getElementById('filter-locations').classList.add('hidden');
        document.getElementById('all-locations').classList.remove('hidden');
      });
    }
    if (seeLessLocation) {
      seeLessLocation.addEventListener('click', function() {
        document.getElementById('all-locations').classList.add('hidden');
        document.getElementById('filter-locations').classList.remove('hidden');
      });
    }
    // See all logic for category
    const seeAllCategory = document.getElementById('see-all-category');
    const seeLessCategory = document.getElementById('see-less-category');
    if (seeAllCategory) {
      seeAllCategory.addEventListener('click', function() {
        document.getElementById('filter-categories').classList.add('hidden');
        document.getElementById('all-categories').classList.remove('hidden');
      });
    }
    if (seeLessCategory) {
      seeLessCategory.addEventListener('click', function() {
        document.getElementById('all-categories').classList.add('hidden');
        document.getElementById('filter-categories').classList.remove('hidden');
      });
    }
    // Toggle single select location, allow unselect
    function toggleLocation(btn) {
      const allBtns = document.querySelectorAll('.filter-location');
      if (btn.classList.contains('bg-orange-100')) {
        btn.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold');
      } else {
        allBtns.forEach(b => b.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold'));
        btn.classList.add('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold');
      }
    }
    document.querySelectorAll('.filter-location').forEach(btn => {
      btn.addEventListener('click', function() { toggleLocation(this); });
    });
    // Toggle single select category, allow unselect
    function toggleCategory(btn) {
      const allBtns = document.querySelectorAll('.filter-category');
      if (btn.classList.contains('bg-orange-100')) {
        btn.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold');
      } else {
        allBtns.forEach(b => b.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold'));
        btn.classList.add('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold');
      }
    }
    document.querySelectorAll('.filter-category').forEach(btn => {
      btn.addEventListener('click', function() { toggleCategory(this); });
    });
    // Reset button: hilangkan semua select
    document.getElementById('filter-form').addEventListener('reset', function() {
      setTimeout(() => {
        document.querySelectorAll('.filter-location').forEach(b => b.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold'));
        document.querySelectorAll('.filter-category').forEach(b => b.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold'));
      }, 10);
    });
    // Submit filter: trigger filter-category event ke halaman utama
    document.getElementById('filter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      document.getElementById('filter-modal').classList.add('hidden');
      // Ambil kategori yang dipilih
      const selectedCatBtn = document.querySelector('.filter-category.bg-orange-100');
      if (selectedCatBtn) {
        const category = selectedCatBtn.dataset.value;
        window.dispatchEvent(new CustomEvent('filter-category', { detail: { category } }));
      } else {
        // Jika tidak ada kategori terpilih, tampilkan semua produk
        window.dispatchEvent(new CustomEvent('filter-category', { detail: { category: null } }));
      }
    });
    // Submit filter: trigger filter-location event ke halaman utama
    document.getElementById('filter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      document.getElementById('filter-modal').classList.add('hidden');
      // Ambil kategori yang dipilih
      const selectedCatBtn = document.querySelector('.filter-location.bg-orange-100');
      if (selectedCatBtn) {
        const location = selectedCatBtn.dataset.value;
        window.dispatchEvent(new CustomEvent('filter-location', { detail: { location } }));
      } else {
        // Jika tidak ada kategori terpilih, tampilkan semua produk
        window.dispatchEvent(new CustomEvent('filter-location', { detail: { location: null } }));
      }
    });
  </script>
</body>
</html>
