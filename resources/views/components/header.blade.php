<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NaZMaLogy</title>

  <!-- Import font Poppins dari Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      padding-top: 80px;
    }

    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 5%;
      background-color: white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      height: 80px;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo-icon {
      width: 40px;
      height: 40px;
      fill: #4039a3;
      margin-right: 10px;
    }

    .logo-text {
      font-size: 24px;
      font-weight: 700;
      color: #333;
    }

    .nav-menu {
      display: flex;
      list-style: none;
      align-items: center; /* Pastikan item di tengah secara vertikal */
      gap: 1.5rem; /* Jarak antar item (gunakan gap untuk konsistensi) */
    }

    .nav-item {
      margin: 0; /* Hilangkan margin tambahan */
    }

    .nav-link {
      text-decoration: none;
      color: #333;
      font-weight: 500;
      transition: color 0.3s;
      padding: 0.5rem 0; /* Tambahkan padding vertikal untuk klik area */
    }

    .nav-link.active,
    .nav-link:hover {
      color: #FF7A00;
    }

    .login-btn {
      background-color: #2E267D;
      color: white;
      border: none;
      border-radius: 50px;
      padding: 10px 30px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }

    .login-btn:hover {
      background-color: #231c60;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
      .nav-menu {
        display: none; /* Sembunyikan menu horizontal */
      }

      .login-btn {
        display: none; /* Sembunyikan tombol login */
      }
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="logo">
      <svg class="logo-icon" viewBox="0 0 100 100">
        <path d="M50 0 L85 25 L85 75 L50 100 L15 75 L15 25 Z" fill="#4039a3" />
        <path d="M35 30 L65 30 L65 40 L50 50 L35 40 Z" fill="white" />
        <path d="M35 55 L50 65 L65 55 L65 75 L35 75 Z" fill="white" />
      </svg>
      <span class="logo-text">NaZMaLogy</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="hidden md:flex">
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="/landingpage" class="nav-link {{ Request::is('landingpage') ? 'active' : '' }}">Home</a>
        </li>
        <li class="nav-item">
          <a href="/training" class="nav-link {{ Request::is('training', 'trainingdetail', 'trainingdata', 'trainingtransaction', 'trainingticket', 'trainingticketdetail') ? 'active' : '' }}">Training</a>
        </li>
        <li class="nav-item">
          <a href="/product" class="nav-link {{ Request::is('product', 'productcart', 'productdata', 'productdetail', 'productorder', 'producttransaction') ? 'active' : '' }}">Product</a>
        </li>
      </ul>
    </nav>

    <!-- Login Button (Desktop) -->
    @auth
      <a href="/profile" class="hidden md:inline-block login-btn">Profile</a>
    @else
      <a href="/login" class="hidden md:inline-block login-btn">Login</a>
    @endauth

    <!-- Hamburger Menu -->
    <div class="md:hidden relative">
      <button id="hamburger-btn" class="text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Dropdown Menu -->
      <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
        <ul class="py-2">
          <li>
            <a href="/landingpage" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
          </li>
          <li>
            <a href="/training" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Training</a>
          </li>
          <li>
            <a href="/product" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Product</a>
          </li>
          @auth
            <li>
              <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
            </li>
          @else
            <li>
              <a href="/login" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </header>

  <script>
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');

    hamburgerBtn.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!hamburgerBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
  </script>

</body>
</html>
