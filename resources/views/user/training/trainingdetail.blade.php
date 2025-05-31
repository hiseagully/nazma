<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NaZMaLogy Training Content
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>

  @include('components.trainingsearchbox', ['action' => '/training/search'])

<link rel="stylesheet" href="{{ asset('css/training/trainingdetail.css') }}">

 </head>
 <body>
  <!-- Main content -->
  <main class="container main-grid">
   <!-- Left card with image -->
   <div class="card-left">
    @if($training->trainingimage && file_exists(public_path('storage/training_images/' . $training->trainingimage)))
      <img alt="{{ $training->trainingtitle }}" class="card-image" height="400"
           src="{{ asset('storage/training_images/' . $training->trainingimage) }}" width="600"/>
    @else
      <img alt="No Image" class="card-image" height="400"
           src="{{ asset('images/no-image.png') }}" width="600"/>
    @endif
   </div>
   <!-- Right card with details -->
   <div class="card-right">
    <div>
     <h2 class="title">
      {{ $training->trainingtitle }}
     </h2>
     <ul class="details-list">
      <li><i class="far fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($training->trainingschedule)->translatedFormat('d F Y') }}</span></li>
      <li><i class="far fa-clock"></i><span>{{ \Carbon\Carbon::parse($training->trainingschedule)->format('H:i') }} WIB</span></li>
      <li><i class="fas fa-map-marker-alt"></i><span>{{ $training->traininglocation }}</span></li>
     </ul>
     <hr class="divider"/>
     <div class="price-row">
      <span>Price:</span>
      <div style="display: flex; flex-direction: column; align-items: flex-start;">
        <span>Rp {{ number_format($training->trainingpricerupiah, 0, ',', '.') }}</span>
        <span style="font-size: 0.9em; color: #888;">(USD ${{ rtrim(rtrim($training->trainingpricedollar, '0'), '.') }})</span>
      </div>
     </div>
    </div>
    <button class="btn-join" type="button">
        <a href="{{ route('trainingdata.form', ['id' => $training->trainingid]) }}" style="text-decoration: none; color: white;">Join Now</a>
    </button>
   </div>
  </main>
  <!-- Description -->
  <section class="container description-section">
   <h3 class="description-title">
    Description
   </h3>
   <p class="description-text">
    {!! $training->trainingdescription !!}
   </p>
   <p class="description-tags">
    @foreach($training->tags ?? [] as $tag)
      <a href="#">{{ $tag }}</a>
    @endforeach
   </p>
  </section>
 </body>
 <x-footer></x-footer>
</html>