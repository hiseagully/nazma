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
  <div class="flex justify-center mt-6 px-4">
    <div
      class="flex items-center bg-[#F7941D] rounded-full w-full max-w-5xl px-6 py-2 space-x-4 relative"
      role="search"
      aria-label="training search and actions"
    >
      <a
        href="/training"
        aria-label="Filter icon"
        class="text-white text-lg flex items-center justify-center flex-shrink-0"
        type="button"
      >
        <i class="fas fa-filter"></i>
      </a>
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

  <script>
    const allTrainings = window.allTrainings || [];
    const searchInput = document.getElementById('search-input');
    const trainingList = document.getElementById('eventGrid');
    const searchEmpty = document.getElementById('search-empty');
    // Tambahkan loading
    let searchLoading = document.getElementById('search-loading');
    if (!searchLoading) {
      searchLoading = document.createElement('span');
      searchLoading.id = 'search-loading';
      searchLoading.className = 'text-orange-500 ml-2';
      searchLoading.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
      // Tempel loading spinner setelah input search
      searchInput.parentNode.insertBefore(searchLoading, searchInput.nextSibling);
    }
    searchLoading.classList.add('hidden');

    function renderTrainings(trainings, keyword = '') {
      let html = '';
      trainings.forEach(training => {
        html += `
        <article class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer select-none" tabindex="0" role="listitem" aria-label="${training.trainingtitle}, ${training.trainingschedule}, ${training.regionname ?? '-'}">
          <img src="${training.trainingimage ? '/storage/training_images/' + training.trainingimage : '/images/noimage.png'}" alt="${training.trainingtitle}" class="w-full h-[180px] object-cover rounded-t-xl" width="300" height="180" loading="lazy" />
          <a href="/trainingdetail/${training.trainingid}">
            <div class="p-3">
              <h3 class="text-sm font-semibold leading-tight">${highlightKeyword(training.trainingtitle, keyword)}</h3>
              <p class="text-xs text-gray-400 mt-1">${training.trainingschedule}</p>
              <p class="text-xs text-gray-400 mt-1 text-right">${training.regionname ?? '-'}</p>
            </div>
          </a>
        </article>
        `;
      });
      trainingList.innerHTML = html;
    }

    function highlightKeyword(text, keyword) {
      if (!keyword) return text;
      const re = new RegExp(`(${keyword.replace(/[.*+?^${}()|[\\]\\]/g, '\\$&')})`, 'gi');
      return text.replace(re, '<span class="bg-yellow-200">$1</span>');
    }

    searchInput.addEventListener('input', function() {
      const keyword = this.value.trim().toLowerCase();
      searchLoading.classList.remove('hidden');
      setTimeout(() => {
        let filtered = allTrainings;
        if (keyword) {
          filtered = allTrainings.filter(t => (t.trainingtitle || '').toLowerCase().includes(keyword));
        }
        renderTrainings(filtered, keyword);
        if (searchEmpty) searchEmpty.classList.toggle('hidden', filtered.length > 0);
        searchLoading.classList.add('hidden');
      }, 300); // simulasi loading 300ms
    });

    // Tampilkan semua training saat load awal
    renderTrainings(allTrainings);
    if (searchEmpty) searchEmpty.classList.add('hidden');
  </script>
</body>
</html>