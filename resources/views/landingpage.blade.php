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
  <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
  <style>
    body {
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>
<body class="bg-[#f4f8ff] text-black">
    <x-header>
      @guest
        <a href="/login" class="btn-login">Login</a>
      @else
        <a href="/profile" class="btn-profile">Profile</a>
      @endguest
    </x-header>
  <main>
    <!-- Hero Section -->
    <section class="hero-section grid grid-cols-1 md:grid-cols-2 items-center gap-6 px-6 py-10">
      <div class="hero-text max-w-xl w-full">
        <p class="hero-subtitle">
          <a href="/landingpage" class="text-[#FF7A00] hover:underline">Home</a>
        </p>
        <h1 class="hero-title text-3xl md:text-4xl font-bold leading-tight mb-4">
          Join the Training<br>
          and Find Our Products<br>
          That You Want
        </h1>
        <a href="/login" class="hero-button inline-flex items-center bg-[#FF7A00] text-white px-4 py-2 rounded-md shadow-md hover:bg-orange-600 transition">
          <span>GET STARTED</span>
          <i class="fas fa-angle-double-right ml-2"></i>
        </a>
      </div>
      <div class="hero-image-container w-full">
        <img
          src="{{ asset('images/landing.png') }}"
          alt="Illustration of a woman presenting charts"
          class="w-full h-auto object-contain"
        />
      </div>
    </section>

    <!-- Our Service Section -->
    <section class="our-service-section">
      <h2 class="our-service-title">Our Service</h2>
      <div class="our-service-grid">
        <div>
          <img
            alt="Icon showing three people collaborating with charts and graphs on a screen"
            class="service-icon"
            height="100"
            src="{{ asset('images/training.png') }}"
            width="100"
          />
          <h3 class="service-title">Training</h3>
          <p class="service-description">
            A curated selection of high-quality local products from Indonesian
            small businesses, handpicked by the Nazma team. These items
            showcase the beauty of local creativity and cultural heritage,
            ranging from handcrafted goods and fashion to traditional regional
            specialties.
          </p>
        </div>
        <div>
          <img
            alt="Icon showing a smartphone with shopping bags and boxes around it"
            class="service-icon"
            height="100"
            src="{{ asset('images/produk.png') }}"
            width="100"
          />
          <h3 class="service-title">Products</h3>
          <p class="service-description">
            A curated selection of high-quality local products from Indonesian
            small businesses, handpicked by the Nazma team. These items
            showcase the beauty of local creativity and cultural heritage,
            ranging from handcrafted goods and fashion to traditional regional
            specialties.
          </p>
        </div>
      </div>
    </section>

    <!-- Training Carousel Section -->
    <section class="carousel-section">
      <h2 class="carousel-title">Training</h2>
      <div class="carousel-wrapper">
        <button
          aria-label="Previous"
          class="carousel-button carousel-prev"
          id="training-prev"
        >
          <i class="fas fa-angle-left"></i>
        </button>
        <div class="carousel-grid" id="training-list"></div>
        <button
          aria-label="Next"
          class="carousel-button carousel-next"
          id="training-next"
        >
          <i class="fas fa-angle-right"></i>
        </button>
      </div>
      <div class="carousel-dots" id="training-dots"></div>
    </section>

    <!-- Products Carousel Section -->
    <section class="carousel-section">
      <h2 class="carousel-title">Products</h2>
      <div class="carousel-wrapper">
        <button
          aria-label="Previous"
          class="carousel-button carousel-prev"
          id="product-prev"
        >
          <i class="fas fa-angle-left"></i>
        </button>
        <div class="carousel-grid" id="product-list"></div>
        <button
          aria-label="Next"
          class="carousel-button carousel-next"
          id="product-next"
        >
          <i class="fas fa-angle-right"></i>
        </button>
      </div>
      <div class="carousel-dots" id="product-dots"></div>
    </section>
  </main>

  <script>
    const trainingData = @json($trainings);
    const productData = @json($products);
</script>
  <script>
    // Carousel state and rendering
    function renderCarousel(containerId, dotsId, data, itemsPerPage, isProduct = false) {
      const container = document.getElementById(containerId);
      const dotsContainer = document.getElementById(dotsId);
      let currentPage = 0;
      const totalPages = Math.ceil(data.length / itemsPerPage);

      function render() {
        container.innerHTML = "";
        dotsContainer.innerHTML = "";
        const start = currentPage * itemsPerPage;
        const end = start + itemsPerPage;
        const pageItems = data.slice(start, end);

        pageItems.forEach((item) => {
          const card = document.createElement("article");
          card.className = "bg-white rounded-xl shadow-md overflow-hidden cursor-pointer";
          if (isProduct && item.disabled) {
            card.classList.add("opacity-40");
          }
          card.innerHTML = `
            <img src="${item.img}" alt="${item.alt}" class="w-full object-cover" height="200" width="300"/>
            <div class="p-4 ${isProduct ? "" : "text-xs"}">
              <p class="text-xs text-gray-900 mb-1 font-semibold">${item.title}</p>
              <p class="text-xs text-gray-400 mb-1">${item.date}</p>
              <p class="text-xs text-gray-400 text-right">${item.location}</p>
            </div>
          `;

          // Tambahkan event listener untuk navigasi
          card.addEventListener("click", () => {
            if (item.url) {
              window.location.href = item.url; // Arahkan ke URL
            }
          });

          container.appendChild(card);
        });

        for (let i = 0; i < totalPages; i++) {
          const dot = document.createElement("span");
          dot.className = `w-2 h-2 rounded-full cursor-pointer ${i === currentPage ? "bg-[#f58220]" : "bg-gray-300"}`;
          dot.addEventListener("click", () => {
            currentPage = i;
            render();
          });
          dotsContainer.appendChild(dot);
        }
      }

      function prev() {
        currentPage = (currentPage - 1 + totalPages) % totalPages;
        render();
      }

      function next() {
        currentPage = (currentPage + 1) % totalPages;
        render();
      }

      render();

      return { prev, next };
    }

    // Initialize carousels
    const trainingCarousel = renderCarousel("training-list", "training-dots", trainingData, 4, false);
    const productCarousel = renderCarousel("product-list", "product-dots", productData, 4, true);

    // Attach event listeners for buttons
    document.getElementById("training-prev").addEventListener("click", trainingCarousel.prev);
    document.getElementById("training-next").addEventListener("click", trainingCarousel.next);
    document.getElementById("product-prev").addEventListener("click", productCarousel.prev);
    document.getElementById("product-next").addEventListener("click", productCarousel.next);

    const dots = document.querySelectorAll('.carousel-dots span');
    let currentSlide = 0;

    function updateDots(index) {
        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');
    }

    // Simulasi ganti slide manual (misalnya via next/prev)
    document.querySelector('.carousel-next').addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % dots.length;
        updateDots(currentSlide);
    });

    document.querySelector('.carousel-prev').addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + dots.length) % dots.length;
        updateDots(currentSlide);
    });
  </script>
  <x-footer></x-footer>
  <x-whatsapp></x-whatsapp>
</body>
</html>