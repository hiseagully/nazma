<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NaZMaLogy Product Data
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>
  <x-trainingsearchbox></x-trainingsearchbox>
  <link rel="stylesheet" href="{{ asset('css/product/productdata.css') }}">
 </head>
 <body class="page-body">
   <!-- Form and payment container -->
   <section aria-label="Trainee data and payment section" class="form-payment-section">
    <div class="form-payment-container">
    <!-- Trainee Data -->
    <form aria-labelledby="trainee-data-title" class="trainee-data-form">
     <h2 id="trainee-data-title" class="form-title">
      Trainee Data
     </h2>
     <div class="form-group">
      <label class="form-label" for="email">
       Email
      </label>
      <input aria-describedby="email-desc" class="form-input email-input" id="email" placeholder="" type="email"/>
     </div>
     <div class="form-group">
      <label class="form-label" for="fullname">
       Full Name
      </label>
      <input class="form-input" id="fullname" placeholder="Full Name" type="text"/>
     </div>
     <fieldset class="form-group">
      <legend class="form-label">
       Date of Birth
      </legend>
      <div class="dob-selects">
       <select aria-label="Day" class="dob-select">
        <option disabled="" selected="">
         Day
        </option>
        <option>
         1
        </option>
        <option>
         2
        </option>
        <option>
         3
        </option>
        <option>
         4
        </option>
        <option>
         5
        </option>
        <option>
         6
        </option>
        <option>
         7
        </option>
        <option>
         8
        </option>
        <option>
         9
        </option>
        <option>
         10
        </option>
        <option>
         11
        </option>
        <option>
         12
        </option>
        <option>
         13
        </option>
        <option>
         14
        </option>
        <option>
         15
        </option>
        <option>
         16
        </option>
        <option>
         17
        </option>
        <option>
         18
        </option>
        <option>
         19
        </option>
        <option>
         20
        </option>
        <option>
         21
        </option>
        <option>
         22
        </option>
        <option>
         23
        </option>
        <option>
         24
        </option>
        <option>
         25
        </option>
        <option>
         26
        </option>
        <option>
         27
        </option>
        <option>
         28
        </option>
        <option>
         29
        </option>
        <option>
         30
        </option>
        <option>
         31
        </option>
       </select>
       <select aria-label="Month" class="dob-select">
        <option disabled="" selected="">
         Month
        </option>
        <option>
         January
        </option>
        <option>
         February
        </option>
        <option>
         March
        </option>
        <option>
         April
        </option>
        <option>
         May
        </option>
        <option>
         June
        </option>
        <option>
         July
        </option>
        <option>
         August
        </option>
        <option>
         September
        </option>
        <option>
         October
        </option>
        <option>
         November
        </option>
        <option>
         December
        </option>
       </select>
       <select aria-label="Year" class="dob-select">
        <option disabled="" selected="">
         Year
        </option>
        <option>
         2025
        </option>
        <option>
         2024
        </option>
        <option>
         2023
        </option>
        <option>
         2022
        </option>
        <option>
         2021
        </option>
        <option>
         2020
        </option>
        <option>
         2019
        </option>
        <option>
         2018
        </option>
        <option>
         2017
        </option>
        <option>
         2016
        </option>
        <option>
         2015
        </option>
        <option>
         2014
        </option>
        <option>
         2013
        </option>
        <option>
         2012
        </option>
        <option>
         2011
        </option>
        <option>
         2010
        </option>
       </select>
      </div>
     </fieldset>
     <fieldset class="form-group">
      <legend class="form-label">
       Gender
      </legend>
      <div class="gender-options">
       <label class="gender-label" for="male">
        <input class="gender-radio" id="male" name="gender" type="radio" value="male"/>
        Male
       </label>
       <label class="gender-label" for="female">
        <input class="gender-radio" id="female" name="gender" type="radio" value="female"/>
        Female
       </label>
      </div>
     </fieldset>
     <div class="form-group">
      <label class="form-label" for="address">
       Address
      </label>
      <textarea class="form-textarea" id="address" placeholder="Address" rows="4"></textarea>
     </div>
    </form>
    
<section
      aria-labelledby="payment-title"
      class="bg-white rounded-xl p-6 w-full max-w-md shadow-md flex flex-col justify-between">
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
        <a href="/producttransaction">
        <button
          class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold py-3 rounded-full hover:brightness-110 transition"
          type="button">
          Checkout
        </button>
        </a>
      </div>
    </section>
   </section>
  </main>
  <x-footer></x-footer>
 </body>
</html>

