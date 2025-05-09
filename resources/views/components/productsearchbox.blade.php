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
 <!-- Search bar -->
 <section class="max-w-5xl mx-auto px-6 sm:px-10 lg:px-0 mt-10 w-full">
   <div class="flex items-center bg-[#f68b1e] rounded-full overflow-hidden max-w-4xl mx-auto" style="height: 44px">
    <button aria-label="Grid icon" class="flex items-center justify-center w-12 h-11 text-white text-lg">
     <i class="fas fa-th-large">
     </i>
    </button>
    <input class="flex-grow rounded-full py-2 px-4 text-sm font-semibold placeholder-gray-400 focus:outline-none bg-white text-black" placeholder="Find the training you want" type="text"/>

    <button aria-label="Search" class="flex items-center justify-center ml-1 w-8 h-8 bg-white rounded-full mr-3 text-[#f68b1e] text-xs">
     <i class="fas fa-search">
     </i>
    </button>
    <button aria-label="Cart" class="flex items-center space-x-1 text-white font-semibold text-sm pr-4">
     <i class="fas fa-shopping-cart">
     </i>
     <span>
      Cart
     </span>
    </button>
    <button aria-label="Transaction" class="flex items-center space-x-1 text-white font-semibold text-sm pr-6">
     <i class="fas fa-exchange-alt">
     </i>
     <span>
      Transaction
     </span>
    </button>
   </div>
  </section>
</body>
</html>