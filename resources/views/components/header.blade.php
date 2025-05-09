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
    }

    .nav-item {
      margin: 0 20px;
    }

    .nav-link {
      text-decoration: none;
      color: #333;
      font-weight: 500;
      transition: color 0.3s;
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

    @media (max-width: 768px) {
      .nav-menu {
        display: none;
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

    <nav>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="/landingpage" class="nav-link {{ Request::is('landingpage') ? 'active' : '' }}">Home</a>
        </li>
        <li class="nav-item">
          <a href="/training" class="nav-link {{ Request::is('training', 'trainingdetail', 'trainingdata', 'trainingtransaction', 'trainingticket') ? 'active' : '' }}">Training</a>
        </li>
        <li class="nav-item">
          <a href="/product" class="nav-link {{ Request::is('product') ? 'active' : '' }}">Product</a>
        </li>
        <li class="nav-item">
          <a href="/contact-us" class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}">Contact Us</a>
        </li>
      </ul>
    </nav>

    <a href="/login" class="login-btn">Login</a>
  </header>

</body>
</html>
