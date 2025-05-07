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
  <link rel="stylesheet" href="{{ asset('css/product/productdetail.css') }}">
</head>
<body>
    <x-header></x-header>
    <!-- Main content -->
    <main class="main-content">
        <!-- Left: Product image -->
        <div class="product-image-container">
        <img
            alt="Small handbag with colorful embroidery on cream background, front view"
            class="product-image"
            src="https://storage.googleapis.com/a1aa/image/f5afda8a-efbd-4e01-be20-b6f0d46f20f9.jpg"
        />
        </div>
        <!-- Right: Product details -->
        <div class="product-details">
        <div>
            <p class="category-text">Aksesoris</p>
            <h2 class="product-title">Tas Warna Nusantara</h2>
            <p class="product-price" id="unitPriceDisplay">$ 80.00</p>
            <div class="rating">
            <i class="fas fa-star star-icon"></i>
            <span class="rating-value">5.0</span>
            </div>
            <div class="quantity-row">
            <span class="qty-label">Qty:</span>
            <div class="qty-controls">
                <button aria-label="Decrease quantity" id="decreaseBtn" type="button" class="qty-btn">−</button>
                <span id="qtyValue" class="qty-value">1</span>
                <button aria-label="Increase quantity" id="increaseBtn" type="button" class="qty-btn">+</button>
            </div>
            </div>
            <div class="price-row">
            <span class="price-label">Price:</span>
            <span class="price-amount" id="priceValue">$ 80.00</span>
            </div>
        </div>
        <div class="action-buttons">
            <button class="btn-outline" type="button">Add to cart</button>
            <button class="btn-gradient" type="button">Buy Now</button>
        </div>
        </div>
    <!-- Product Description -->
    <section class="product-description">
        <h3>Product Description</h3>
        <p>
        Elevate your style with this chic small handbag, crafted from high-quality materials with fine stitching details. Its compact size is perfect for carrying your essentials like a wallet, phone, keys, and a few makeup items. Featuring a detachable and adjustable strap, you can wear it as a classic handbag or a stylish crossbody. Whether you're heading to a casual outing, a party, or a weekend hangout, this versatile bag adds a touch of elegance to any look.
        </p>
        <p>
        Specifications:
        <ul>
            <li>Material: Premium synthetic leather / PU leather</li>
            <li>Size: 20 cm x 15 cm x 8 cm</li>
            <li>Features: Adjustable and detachable shoulder strap, inner pocket</li>
            <li>Colors: Black, Cream, Dusty Pink</li>
        </ul>
        </p>
    </section>
    </main>
    <!-- Footer -->
</body>
<x-footer></x-footer>
</html>