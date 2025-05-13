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
</head>
<body class="bg-[#F5F7FA]">
  <!-- Search Component -->
  <div class="flex justify-center mt-6">
    <div
      class="flex items-center bg-[#F7941D] rounded-full w-[75%] max-w-5xl px-6 py-2 space-x-4"
      role="search"
      aria-label="Training search and actions"
    >
      <a
        href="/training"
        aria-label="Grid view icon"
        class="text-white text-lg flex items-center justify-center"
        type="button"
      >
        <i class="fas fa-th-large"></i>
      </a>
      <input class="flex-grow rounded-full py-2 px-4 text-sm font-semibold placeholder-gray-400 focus:outline-none bg-white text-black" placeholder="Find the training you want" type="text"/>
      <button
        aria-label="Search"
        class="text-[#F7941D] bg-white rounded-full p-2 hover:bg-gray-100"
        type="submit"
      >
        <i class="fas fa-search"></i>
      </button>
      <a
        href="/trainingtransaction"
        class="flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Training Transaction"
      >
        <i class="fas fa-exchange-alt"></i>
        <span>Transaction</span>
      </a>
      <a
        href="/trainingticket"
        class="flex items-center space-x-1 text-white text-sm font-semibold"
        aria-label="Go to Training Ticket"
      >
        <i class="fas fa-ticket-alt"></i>
        <span>Ticket</span>
      </a>
    </div>
  </div>
</body>
</html>

