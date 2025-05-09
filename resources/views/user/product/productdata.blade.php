<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>NaZMaLogy Product Page - Body Only</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{ asset('css/product/productdata.css') }}">
</head>
<x-header></x-header>
<body class="bg-[#f5f8ff] min-h-screen flex flex-col">
<main class="flex flex-col lg:flex-row gap-10 mb-20">

    <!-- Recipient form -->
    <section
      aria-labelledby="recipient-title"
      class="bg-white rounded-xl p-8 w-[75%] max-w-7xl shadow-md"
    >
      <h2
        class="font-bold text-lg mb-6 border-b border-gray-300 pb-2"
        id="recipient-title"
      >
        Recipient
      </h2>
      <form class="flex flex-col gap-6">
        <div>
          <label class="block font-semibold mb-1" for="email">Email</label>
          <input
            aria-required="true"
            class="w-full bg-[#f9fafb] rounded-md py-3 px-4 text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400"
            id="email"
            placeholder=""
            type="email"
          />
        </div>
        <div>
          <label class="block font-semibold mb-1" for="name">Name</label>
          <input
            aria-required="true"
            class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400"
            id="name"
            placeholder="Full Name"
            type="text"
          />
        </div>
        <div>
          <label class="block font-semibold mb-1" for="notelp">No Telp</label>
          <input
            aria-required="true"
            class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400"
            id="notelp"
            placeholder="No Telp"
            type="tel"
          />
        </div>
        <div>
          <label class="block font-semibold mb-1" for="address">Address</label>
          <select
            aria-required="true"
            class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400"
            id="address"
          >
            <option class="text-gray-300" disabled selected>Address</option>
            <option>Address 1</option>
            <option>Address 2</option>
            <option>Address 3</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold mb-1" for="fulladdress"
            >Full Address</label
          >
          <textarea
            aria-required="true"
            class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 resize-none focus:outline-none focus:ring-2 focus:ring-orange-400"
            id="fulladdress"
            placeholder="Full Address"
            rows="3"
          ></textarea>
        </div>
      </form>
    </section>
    <!-- Payment summary -->
    <section
      aria-labelledby="payment-title"
      class="bg-white rounded-xl p-6 w-full max-w-md shadow-md flex flex-col justify-between"
    >
      <h2 class="font-bold text-lg mb-6" id="payment-title">Payment</h2>
      <div class="flex flex-col gap-6">
        <!-- Product 1 -->
        <div class="flex gap-4 items-center">
          <img
            alt="White handbag with floral pattern, product image for Tas Warna Nusantara"
            class="w-16 h-16 rounded-lg object-cover flex-shrink-0"
            height="64"
            loading="lazy"
            src="https://storage.googleapis.com/a1aa/image/fd059e58-4e01-439b-b506-9bdd469280a2.jpg"
            width="64"
          />
          <div class="flex flex-col">
            <span class="text-xs text-gray-500">Aksesoris</span>
            <span class="font-semibold text-sm">Tas Warna Nusantara</span>
            <span class="text-xs text-gray-600">Qty: 1</span>
          </div>
          <div class="ml-auto font-semibold text-sm">$ 80</div>
        </div>
        <hr class="border-gray-300" />
        <!-- Product 2 -->
        <div class="flex gap-4 items-center">
          <img
            alt="Gray baseball cap with NY logo, product image for Topi Rupa Kita"
            class="w-16 h-16 rounded-lg object-cover flex-shrink-0"
            height="64"
            loading="lazy"
            src="https://storage.googleapis.com/a1aa/image/55b7b671-70f1-4164-b960-2de9270ee20a.jpg"
            width="64"
          />
          <div class="flex flex-col">
            <span class="text-xs text-gray-500">Aksesoris</span>
            <span class="font-semibold text-sm">Topi Rupa Kita</span>
            <span class="text-xs text-gray-600">Qty: 1</span>
          </div>
          <div class="ml-auto font-semibold text-sm">$ 80</div>
        </div>
        <hr class="border-gray-300" />
        <!-- Totals -->
        <div class="flex justify-between font-semibold text-sm">
          <span>Total Purchase:</span>
          <span>$ 160</span>
        </div>
        <div class="flex flex-col gap-4">
          <div>
            <label class="block font-semibold mb-1" for="payment-method"
              >Payment:</label
            >
            <select
              aria-required="true"
              class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400"
              id="payment-method"
            >
              <option class="text-gray-300" disabled selected>Choose Payment</option>
              <option>Credit Card</option>
              <option>Bank Transfer</option>
              <option>Paypal</option>
            </select>
          </div>
          <div>
            <label class="block font-semibold mb-1" for="courier">Courier:</label>
            <select
              aria-required="true"
              class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm placeholder:text-gray-300 appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-orange-400"
              id="courier"
            >
              <option class="text-gray-300" disabled selected>Choose Courier</option>
              <option>JNE</option>
              <option>POS Indonesia</option>
              <option>TIKI</option>
            </select>
          </div>
        </div>
        <div class="flex justify-between font-semibold text-sm">
          <span>Total Payment:</span>
          <span>$ 163</span>
        </div>
        <button
          class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold py-3 rounded-full hover:brightness-110 transition"
          type="button"
        >
          Checkout
        </button>
      </div>
    </section>
  </main>
</body>
<x-footer></x-footer>
</html>
