<html lang="en" class="scroll-smooth">
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
  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById("dropdownMenu");
      dropdown.classList.toggle("hidden");
    }
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById("dropdownMenu");
      const button = document.getElementById("dropdownButton");
      if (!dropdown.contains(event.target) && !button.contains(event.target)) {
        dropdown.classList.add("hidden");
      }
    });
  </script>
</head>
<body class="bg-[#F5F7FA]">
  <!-- Search Component -->
  <div class="w-full max-w-5xl mx-auto px-4 pt-6">
    <div
      class="flex items-center bg-[#F7941D] rounded-full w-full px-6 py-2 space-x-4 relative"
      role="search"
      aria-label="training search and actions"
    >
      <button
        aria-label="Filter"
        class="text-white text-lg flex items-center justify-center flex-shrink-0"
        type="button"
        id="open-filter-modal"
      >
        <i class="fas fa-filter"></i>
      </button>
      <input
        class="flex-grow rounded-full py-2 px-4 text-sm font-semibold placeholder-gray-400 focus:outline-none bg-white text-black min-w-0"
        placeholder="Find the training you want"
        type="text"
        aria-label="Search training"
        id="search-input"
        autocomplete="off"
      />
      <button
        aria-label="Search"
        class="text-[#F7941D] bg-white rounded-full p-2 hover:bg-gray-100 flex-shrink-0"
        type="submit"
      >
        <i class="fas fa-search"></i>
      </button>

      <!-- Dropdown for Transaction and Ticket on mobile -->
      <div class="relative md:hidden flex-shrink-0">
        <button
          id="dropdownButton"
          class="flex items-center justify-center text-white text-lg"
          aria-label="More options"
          aria-haspopup="true"
          aria-expanded="false"
          onclick="toggleDropdown()"
          type="button"
        >
          <i class="fas fa-bars"></i>
        </button>

        <div
          id="dropdownMenu"
          class="hidden absolute top-full right-0 mt-2 w-40 bg-[#F7941D] rounded-md shadow-lg z-10"
          role="menu"
          aria-label="More options menu"
        >
          <a
            href="/trainingtransaction"
            class="block px-4 py-2 text-sm text-white hover:bg-[#e67e22]"
            role="menuitem"
            tabindex="-1"
          >
            Transaction
          </a>
          <a
            href="/trainingticket"
            class="block px-4 py-2 text-sm text-white hover:bg-[#e67e22]"
            role="menuitem"
            tabindex="-1"
          >
            Ticket
          </a>
        </div>
      </div>

      <!-- Transaction Link (Visible on medium screens and above) -->
      <a
        href="/trainingtransaction"
        class="hidden md:flex items-center space-x-1 text-white text-sm font-semibold whitespace-nowrap"
        aria-label="Go to Training Transaction"
      >
        <i class="fas fa-exchange-alt"></i>
        <span>Transaction</span>
      </a>

      <!-- Ticket Link (Visible on medium screens and above) -->
      <a
        href="/trainingticket"
        class="hidden md:flex items-center space-x-1 text-white text-sm font-semibold whitespace-nowrap"
        aria-label="Go to Training Ticket"
      >
        <i class="fas fa-ticket-alt"></i>
        <span>Ticket</span>
      </a>
    </div>
  </div>

  <!-- Modal Filter -->
<div id="filter-modal" class="fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center hidden">
  <div class="w-full max-w-lg bg-white rounded-lg shadow-[0_0_15px_rgba(0,0,0,0.15)] p-8 relative">
    <button id="close-filter" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl" aria-label="Close">
      <i class="fas fa-times"></i>
    </button>
    <h2 class="text-lg mb-6 font-normal">Filter</h2>
    <hr class="border-t border-gray-300 mb-6" />
    <form id="filter-form">
      <div class="mb-8">
        <label for="lokasi" class="block text-base font-normal mb-4 text-black">Lokasi</label>
        <div id="lokasi" class="grid grid-cols-3 gap-x-6 gap-y-4 max-w-full w-full">
          @php
            $regions = \App\Models\TrainingRegion::all()->sortBy('trainingregionname')->values();
          @endphp
          @foreach($regions as $region)
            <button type="button" class="bg-gray-100 rounded-xl py-3 px-6 text-center text-black font-normal text-sm filter-location">{{ $region->trainingregionname }}</button>
          @endforeach
        </div>
        <div class="mt-4 text-center text-gray-300 text-sm font-normal flex justify-center items-center space-x-1 select-none cursor-default">
          <span>See all</span>
          <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
        </div>
      </div>
      <div class="flex justify-end space-x-6">
        <button type="reset" class="text-orange-500 font-normal text-sm px-10 py-3 rounded-full border-2 border-orange-500 hover:bg-orange-50 transition-colors">Reset</button>
        <button type="submit" class="text-white font-normal text-sm px-10 py-3 rounded-full bg-gradient-to-r from-orange-400 to-orange-600 hover:from-orange-500 hover:to-orange-700 transition-colors">Set</button>
      </div>
    </form>
  </div>
</div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('open-filter-modal').onclick = function() {
      document.getElementById('filter-modal').classList.remove('hidden');
    };
    document.getElementById('close-filter').onclick = function() {
      document.getElementById('filter-modal').classList.add('hidden');
    };
    document.getElementById('filter-modal').onclick = function(e) {
      if (e.target === this) this.classList.add('hidden');
    };
    // Toggle single select location, allow unselect, style sama seperti productsearchbox
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
    // Reset button: hilangkan semua select
    document.getElementById('filter-form').addEventListener('reset', function() {
      setTimeout(() => {
        document.querySelectorAll('.filter-location').forEach(b => b.classList.remove('bg-orange-100', 'border', 'border-orange-400', 'text-orange-600', 'font-semibold'));
      }, 10);
    });
    // Submit filter: trigger filter-location event ke halaman utama
    document.getElementById('filter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      document.getElementById('filter-modal').classList.add('hidden');
      const selectedLocBtn = document.querySelector('.filter-location.bg-orange-100');
      if (selectedLocBtn) {
        const location = selectedLocBtn.textContent.trim();
        window.dispatchEvent(new CustomEvent('filter-location', { detail: { location } }));
      } else {
        window.dispatchEvent(new CustomEvent('filter-location', { detail: { location: null } }));
      }
    });
  });
  </script>
</body>
</html>