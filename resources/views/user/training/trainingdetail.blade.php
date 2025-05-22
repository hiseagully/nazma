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
    <img alt="Workshop Contract Development poster with man in black suit, orange and white text and details, QR code, and date 21-22 April 2025" class="card-image" height="400" src="https://storage.googleapis.com/a1aa/image/502f71a3-b0b9-46ea-acf1-f92eec5ed9a7.jpg" width="600"/>
    <div aria-label="More options" class="more-options">
     <span>•</span>
     <span>•</span>
     <span>•</span>
    </div>
   </div>
   <!-- Right card with details -->
   <div class="card-right">
    <div>
     <h2 class="title">
      Workshop Contract Development
     </h2>
     <ul class="details-list">
      <li><i class="far fa-calendar-alt"></i><span>21–22 April 2025</span></li>
      <li><i class="far fa-clock"></i><span>15.00 WIB</span></li>
      <li><i class="fas fa-map-marker-alt"></i><span>Yogyakarta, Indonesia</span></li>
     </ul>
     <hr class="divider"/>
     <div class="price-row">
      <span>Price:</span>
      <div style="display: flex; flex-direction: column; align-items: flex-start;">
        <span>Rp 200.000</span>
        <span style="font-size: 0.9em; color: #888;">(USD $12,18)</span>
      </div>
     </div>
    </div>
    <button class="btn-join" type="button">
        <a href="/trainingdata" style="text-decoration: none; color: white;">Join Now</a>
    </button>
   </div>
  </main>
  <!-- Description -->
  <section class="container description-section">
   <h3 class="description-title">
    Description
   </h3>
   <p class="description-text">
    <span class="emoji">📜</span>
    Workshop Contract Development: Kuasai Penyusunan Kontrak Bisnis Secara Profesional ⚖️📝
   </p>
   <p class="description-text">
    Kontrak bukan hanya sekadar dokumen formalitas. Ia adalah tulang punggung legal dalam setiap kesepakatan bisnis. Workshop ini dirancang untuk membekali Anda dengan pemahaman mendalam mengenai hukum kontrak dan keterampilan menyusun dokumen perjanjian yang sah, jelas, dan melindungi semua pihak.
   </p>
   <p class="description-text">
    <span class="emoji">📞</span>
    Daftar Sekarang di NaZMa Office!<br/>
    WA: 0823-2410-2401 (Meylin) | 0813-9211-3276 (Wiwit AB)<br/>
    <span class="emoji">📧</span>
    Email: itmcnazma@gmail.com<br/>
    <span class="emoji">🌐</span>
    Web: www.nazmaoffice.com<br/>
    <span class="emoji">📍</span>
    Alamat: Jl. Selokan Mataram No. 16, Pogung Dalangan, Sleman, Yogyakarta<br/>
    <span class="emoji">📱</span>
    IG: @nazma_office | FB, YouTube, LinkedIn: NaZMa Office
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
 <x-footer></x-footer>
</html>