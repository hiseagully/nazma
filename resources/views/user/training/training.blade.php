<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Training Event</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <x-header></x-header>
  @include('components.trainingsearchbox', ['action' => '/training/search'])
  <link rel="stylesheet" href="{{ asset('css/training/training.css') }}">
</head>

<body class="bg-[#F5F7FA] font-[Inter,sans-serif]">
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h2 class="text-[#F7941D] font-semibold text-lg mb-4 select-none">Event</h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6" id="eventGrid" role="list">
      @forelse ($trainings as $training)
        <article
          class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer select-none"
          tabindex="0"
          role="listitem"
          aria-label="{{ $training->trainingtitle }}, {{ $training->trainingschedule }}, {{ $training->traininglocation }}"
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
              <p class="text-xs text-gray-400 mt-1 text-right">{{ $training->traininglocation }}</p>
            </div>
          </a>
        </article>
      @empty
        <p class="text-gray-500 col-span-full">Tidak ada program pelatihan tersedia.</p>
      @endforelse
    </div>
  </main>
  <x-footer></x-footer>
</body>
</html>
