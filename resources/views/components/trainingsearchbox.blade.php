<html lang="en" class="scroll-smooth">
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
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById("dropdownMenu");
      const button = document.getElementById("dropdownButton");
      if (!dropdown.contains(event.target) && !button.contains(event.target)) {
        dropdown.classList.add("hidden");
      }
    });
  </script>
</head>
<body class="bg-[#F5F7FA]">
  <!-- Search Component -->
  <div class="flex justify-center mt-6 px-4">
    <div
      class="flex items-center bg-[#F7941D] rounded-full w-full max-w-5xl px-6 py-2 space-x-4 relative"
      role="search"
      aria-label="training search and actions"
    >
      <a
        href="/training"
        aria-label="Filter icon"
        class="text-white text-lg flex items-center justify-center flex-shrink-0"
        type="button"
      >
        <i class="fas fa-filter"></i>
      </a>
      <input
        class="flex-grow rounded-full py-2 px-4 text-sm font-semibold placeholder-gray-400 focus:outline-none bg-white text-black min-w-0"
        placeholder="Find the training you want"
        type="text"
        aria-label="Search training"
      />
      <button
        aria-label="Search"
        class="text-[#F7941D] bg-white rounded-full p-2 hover:bg-gray-100 flex-shrink-0"
        type="submit"
      >
        <i class="fas fa-search"></i>
      </button>

      <!-- Dropdown for Transaction and Ticket on mobile -->
      <div class="relative md:hidden flex-shrink-0">
        <button
          id="dropdownButton"
          class="flex items-center justify-center text-white text-lg"
          aria-label="More options"
          aria-haspopup="true"
          aria-expanded="false"
          onclick="toggleDropdown()"
          type="button"
        >
          <i class="fas fa-bars"></i>
        </button>

        <div
          id="dropdownMenu"
          class="hidden absolute top-full right-0 mt-2 w-40 bg-[#F7941D] rounded-md shadow-lg z-10"
          role="menu"
          aria-label="More options menu"
        >
          <a
            href="/trainingtransaction"
            class="block px-4 py-2 text-sm text-white hover:bg-[#e67e22]"
            role="menuitem"
            tabindex="-1"
          >
            Transaction
          </a>
          <a
            href="/trainingticket"
            class="block px-4 py-2 text-sm text-white hover:bg-[#e67e22]"
            role="menuitem"
            tabindex="-1"
          >
            Ticket
          </a>
        </div>
      </div>

      <!-- Transaction Link (Visible on medium screens and above) -->
      <a
        href="/trainingtransaction"
        class="hidden md:flex items-center space-x-1 text-white text-sm font-semibold whitespace-nowrap"
        aria-label="Go to Training Transaction"
      >
        <i class="fas fa-exchange-alt"></i>
        <span>Transaction</span>
      </a>

      <!-- Ticket Link (Visible on medium screens and above) -->
      <a
        href="/trainingticket"
        class="hidden md:flex items-center space-x-1 text-white text-sm font-semibold whitespace-nowrap"
        aria-label="Go to Training Ticket"
      >
        <i class="fas fa-ticket-alt"></i>
        <span>Ticket</span>
      </a>
    </div>
  </div>
</body>
</html>