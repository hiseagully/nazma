<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{ asset('css/product/productcart.css') }}">
</head>
<x-header></x-header>
<x-productsearchbox></x-productsearchbox>
<body class="body-bg flex flex-col min-h-[calc(100vh-144px)] px-6 md:px-0">
<main class="cart-container">
    <h2 class="cart-title">Cart</h2>
    <div class="cart-items-grid">
      <!-- Item 1 -->
      <div class="cart-item">
        <img
          src="https://storage.googleapis.com/a1aa/image/15dc16e0-b73f-4752-f14b-c7ad712bae61.jpg"
          alt="White handbag with colorful pattern, short handle, displayed on white background"
          class="cart-item-image"
          width="96"
          height="96"
        />
        <div class="cart-item-text">
          <p class="cart-item-category">Aksesoris</p>
          <p class="cart-item-name">Tas Warna Nusantara</p>
          <p class="cart-item-qty">Qty: 1</p>
        </div>
      </div>
      <!-- Item 2 -->
      <div class="cart-item">
        <img
          src="https://storage.googleapis.com/a1aa/image/95f522ef-ddcd-415e-68e3-cd3b2c30b2a4.jpg"
          alt="Black baseball cap with white NY logo, slightly tilted, on gray background"
          class="cart-item-image"
          width="96"
          height="96"
        />
        <div class="cart-item-text">
          <p class="cart-item-category">Aksesoris</p>
          <p class="cart-item-name">Topi Rupa Kita</p>
          <p class="cart-item-qty">Qty: 1</p>
        </div>
      </div>
    </div>
    <div class="checkout-wrapper">
      <button class="checkout-button">Checkout</button>
    </div>
  </main>
</body>
<x-footer></x-footer>
</html>