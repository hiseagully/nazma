<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Training Event</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/training/training.css') }}">
  <x-header></x-header>
</head>

<body class="bg-[#F5F7FA] font-[Inter,sans-serif]">
  @php
    $jsonTrainings = $trainings->map(function($t) {
      return [
        'trainingid' => $t->trainingid,
        'trainingtitle' => $t->trainingtitle,
        'trainingschedule' => \Carbon\Carbon::parse($t->trainingschedule)->format('d-m-Y'),
        'regionname' => $t->region->trainingregionname ?? '-',
        'trainingimage' => $t->trainingimage,
      ];
    })->values()->toArray();
  @endphp
  <script>
    window.allTrainings = @json($jsonTrainings);
    // --- LOGIC SEARCH ala PRODUCT ---
    document.addEventListener('DOMContentLoaded', function() {
      const allTrainings = window.allTrainings || [];
      const searchInput = document.getElementById('search-input');
      const eventGrid = document.getElementById('eventGrid');
      let searchLoading = document.getElementById('search-loading');
      let searchEmpty = document.getElementById('search-empty');
      let lastKeyword = '';
      if (!searchLoading) {
        searchLoading = document.createElement('span');
        searchLoading.id = 'search-loading';
        searchLoading.className = 'text-orange-500 ml-2';
        searchLoading.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        searchInput.parentNode.appendChild(searchLoading);
      }
      searchLoading.classList.add('hidden');
      function highlightKeyword(text, keyword) {
        if (!keyword) return text;
        const re = new RegExp(`(${keyword.replace(/[.*+?^${}()|[\\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(re, '<span class="bg-yellow-200">$1</span>');
      }
      function renderTrainings(list, keyword = '') {
        let html = '';
        list.forEach(training => {
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
        eventGrid.innerHTML = html;
      }
      searchInput.addEventListener('input', function() {
        const keyword = this.value.trim().toLowerCase();
        if (keyword === lastKeyword) return;
        lastKeyword = keyword;
        searchLoading.classList.remove('hidden');
        setTimeout(() => {
          let filtered = allTrainings;
          if (keyword) {
            // Urutkan: match di atas, sisanya di bawah
            const match = allTrainings.filter(t => (t.trainingtitle || '').toLowerCase().includes(keyword));
            const notMatch = allTrainings.filter(t => !(t.trainingtitle || '').toLowerCase().includes(keyword));
            filtered = [...match, ...notMatch];
          }
          renderTrainings(filtered.filter(t => !keyword || (t.trainingtitle || '').toLowerCase().includes(keyword)), keyword);
          if (searchEmpty) searchEmpty.classList.toggle('hidden', filtered.length > 0 && (keyword ? filtered.some(t => (t.trainingtitle || '').toLowerCase().includes(keyword)) : true));
          searchLoading.classList.add('hidden');
        }, 300);
      });
      // Tampilkan semua training saat load awal
      renderTrainings(allTrainings);
      if (searchEmpty) searchEmpty.classList.add('hidden');
    });
  </script>

  @include('components.trainingsearchbox', ['action' => '/training/search'])

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h2 class="text-[#F7941D] font-semibold text-lg mb-4 select-none">Event</h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6" id="eventGrid" role="list">
      @forelse ($trainings as $training)
        <article
          class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer select-none"
          tabindex="0"
          role="listitem"
          aria-label="{{ $training->trainingtitle }}, {{ $training->trainingschedule }}, {{ $training->region->trainingregionname ?? '-' }}"
        >
          <img
            src="{{ asset('storage/training_images/' . $training->trainingimage) }}"
            alt="{{ $training->trainingtitle }}"
            class="w-full h-[180px] object-cover rounded-t-xl"
            width="300"
            height="180"
            loading="lazy"
          />
          <a href="{{ route('training.show', $training->trainingid) }}">
            <div class="p-3">
              <h3 class="text-sm font-semibold leading-tight">{{ $training->trainingtitle }}</h3>
              <p class="text-xs text-gray-400 mt-1">
                {{ \Carbon\Carbon::parse($training->trainingschedule)->format('d-m-Y') }}
              </p>
              <p class="text-xs text-gray-400 mt-1 text-right">
                {{ $training->region->trainingregionname ?? '-' }}
              </p>
            </div>
          </a>
        </article>
      @empty
        <p class="text-gray-500 col-span-full" id="search-empty">Tidak ada program pelatihan tersedia.</p>
      @endforelse
    </div>
  </main>
  <x-footer></x-footer>
</body>
</html>
