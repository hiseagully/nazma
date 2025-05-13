<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NaZMaLogy Training
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <x-header></x-header>
  <x-trainingsearchbox></x-trainingsearchbox>
  <link rel="stylesheet" href="{{ asset('css/training/trainingdata.css') }}">
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
    <!-- Payment -->
    <aside aria-labelledby="payment-title" class="payment-aside">
     <h2 class="form-title" id="payment-title">
      Payment
     </h2>
     <div class="payment-info">
      <img alt="Workshop Contract Development training thumbnail with a person and text on blue background" class="payment-img" height="64" src="https://storage.googleapis.com/a1aa/image/5cc832b6-99f0-4603-2d53-07e6bcdf5b36.jpg" width="64"/>
      <div>
       <h3 class="payment-title">
        Workshop Contract Development
       </h3>
       <p class="payment-date">
        21–22 April 2025
       </p>
      </div>
     </div>
     <hr class="payment-divider"/>
     <div class="payment-total">
      <span>
       Total:
      </span>
      <span>
       $ 267
      </span>
     </div>
     <div class="form-group">
      <label class="form-label" for="payment-method">
       Payment:
      </label>
      <select class="payment-select" disabled="" id="payment-method">
       <option selected="">
        Choose Payment
       </option>
      </select>
     </div>
     <button class="checkout-button" type="submit">
      Checkout
     </button>
    </aside>
   </section>
  </main>
  <x-footer></x-footer>
 </body>
</html>