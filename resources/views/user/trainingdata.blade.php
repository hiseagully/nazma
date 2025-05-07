<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>NaZMaLogy Training Form</title>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <link href="styles.css" rel="stylesheet" />
  <x-header></x-header>
  <x-searchbox></x-searchbox>
  <link rel="stylesheet" href="{{ asset('css/training/trainingdata.css') }}">
</head>
<body>
  <main>
    <!-- Trainee Data -->
    <section aria-labelledby="trainee-data-title" class="trainee-data">
      <h2 id="trainee-data-title" class="section-title">Trainee Data</h2>
      <form class="form-space">
        <div>
          <label for="email" class="label">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            autocomplete="email"
            class="input-email"
            placeholder=""
          />
        </div>
        <div>
          <label for="fullname" class="label">Full Name</label>
          <input
            id="fullname"
            name="fullname"
            type="text"
            autocomplete="name"
            class="input-fullname"
            placeholder="Full Name"
          />
        </div>
        <div>
          <label class="label">Date of Birth</label>
          <div class="dob-selects">
            <select id="day" name="day" aria-label="Day" class="select-dob">
              <option disabled selected>Day</option>
              <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
              <option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
              <option>11</option><option>12</option><option>13</option><option>14</option><option>15</option>
              <option>16</option><option>17</option><option>18</option><option>19</option><option>20</option>
              <option>21</option><option>22</option><option>23</option><option>24</option><option>25</option>
              <option>26</option><option>27</option><option>28</option><option>29</option><option>30</option>
              <option>31</option>
            </select>
            <select id="month" name="month" aria-label="Month" class="select-dob">
              <option disabled selected>Month</option>
              <option>January</option><option>February</option><option>March</option><option>April</option>
              <option>May</option><option>June</option><option>July</option><option>August</option>
              <option>September</option><option>October</option><option>November</option><option>December</option>
            </select>
            <select id="year" name="year" aria-label="Year" class="select-dob">
              <option disabled selected>Year</option>
              <option>2025</option><option>2024</option><option>2023</option><option>2022</option>
              <option>2021</option><option>2020</option><option>2019</option><option>2018</option>
              <option>2017</option><option>2016</option><option>2015</option><option>2014</option>
              <option>2013</option><option>2012</option><option>2011</option><option>2010</option>
            </select>
          </div>
        </div>
        <div>
          <span class="label">Gender</span>
          <div class="gender-options">
            <label for="male" class="gender-label">
              <input id="male" name="gender" type="radio" value="male" class="gender-input" />
              Male
            </label>
            <label for="female" class="gender-label">
              <input id="female" name="gender" type="radio" value="female" class="gender-input" />
              Female
            </label>
          </div>
        </div>
        <div>
          <label for="address" class="label">Address</label>
          <textarea
            id="address"
            name="address"
            rows="4"
            placeholder="Address"
            class="textarea-address"
          ></textarea>
        </div>
      </form>
    </section>
    <!-- Payment -->
    <aside aria-labelledby="payment-title" class="payment-section">
      <h2 id="payment-title" class="section-title">Payment</h2>
      <div class="payment-info">
        <img
          src="https://storage.googleapis.com/a1aa/image/0a8f404a-6ee6-4e83-8fb9-f06304154d77.jpg"
          alt="Workshop Contract Development event thumbnail with a man in black shirt and orange and white text on dark blue background"
          class="payment-img"
          loading="lazy"
          width="64"
          height="64"
        />
        <div>
          <h3 class="payment-title">Workshop Contract Development</h3>
          <p class="payment-date">21-22 April 2025</p>
        </div>
      </div>
      <div class="payment-summary">
        <div class="payment-row">
          <span>Total:</span>
          <span>$ 267</span>
        </div>
        <div class="payment-row">
          <span>Payment:</span>
          <select disabled class="payment-select" aria-label="Choose Payment">
            <option selected>Choose Payment</option>
          </select>
        </div>
      </div>
      <button type="button" class="checkout-btn">Checkout</button>
    </aside>
  </main>
</body>
<x-footer></x-footer>
</html>