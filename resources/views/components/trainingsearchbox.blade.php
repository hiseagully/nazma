<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Search Component</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById("dropdownMenu");
      dropdown.classList.toggle("hidden");
    }
  </script>
</head>
<body class="bg-[#F5F7FA]">
  <!-- Search Component -->
  <div class="flex justify-center mt-6">
    <div
      class="flex items-center bg-[#F7941D] rounded-full w-[75%] max-w-5xl px-6 py-2 space-x-4 relative"
      role="search"
      aria-label="Training search and actions"
    >
      <!-- Grid View Icon -->
      <a
        href="/training"
        aria-label="Grid view icon"
        class="text-white text-lg flex items-center justify-center"
        type="button"
      >
        <i class="fas fa-th-large"></i>
      </a>

      <!-- Search Form -->
      <form action="{{ $action ?? '/training/search' }}" method="GET" class="flex-grow flex items-center space-x-2">
        <!-- Search Input -->
        <input
          class="flex-grow rounded-full py-2 px-4 text-sm font-semibold placeholder-gray-400 focus:outline-none bg-white text-black"
          placeholder="Find the training you want"
          type="text"
          name="q"
          value="{{ request('q') }}"
          aria-label="Search training"
        />
        <!-- Search Button -->
        <button
          aria-label="Search"
          class="text-[#F7941D] bg-white rounded-full p-2 hover:bg-gray-100"
          type="submit"
        >
          <i class="fas fa-search"></i>
        </button>
      </form>

      <!-- Hamburger Menu -->
      <div class="relative">
        <button
          class="flex md:hidden items-center justify-center text-white text-lg"
          aria-label="More options"
          onclick="toggleDropdown()"
        >
          <i class="fas fa-bars"></i> <!-- Setrip tiga -->
        </button>

        <!-- Dropdown Menu -->
        <div
          id="dropdownMenu"
          class="hidden absolute top-full right-0 mt-2 w-40 bg-[#F7941D] rounded-md shadow-lg z-10"
        >
          <a
            href="/trainingtransaction"
            class="block px-4 py-2 text-sm text-white hover:bg-[#e67e22]"
          >
            Transaction
          </a>
          <a
            href="/trainingticket"
            class="block px-4 py-2 text-sm text-white hover:bg-[#e67e22]"
          >
            Ticket
          </a>
        </div>
      </div>

      <!-- Transaction Link (Visible on medium screens and above) -->
      <a
        href="/trainingtransaction"
        class="hidden md:flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Training Transaction"
      >
        <i class="fas fa-exchange-alt"></i>
        <span>Transaction</span>
      </a>

      <!-- Ticket Link (Visible on medium screens and above) -->
      <a
        href="/trainingticket"
        class="hidden md:flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Training Ticket"
      >
        <i class="fas fa-ticket-alt"></i>
        <span>Ticket</span>
      </a>
    </div>
  </div>
</body>
</html>

