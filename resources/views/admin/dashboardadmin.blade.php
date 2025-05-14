<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
   rel="stylesheet"
  />
  <link
   href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
   rel="stylesheet"
  />
  <style>
   body {
    font-family: "Poppins", sans-serif;
   }
  </style>
 </head>
 <body class="bg-white text-gray-900">
  <div class="flex min-h-screen border border-gray-200">
   <!-- Sidebar backdrop for mobile -->
   <div
    id="sidebar-backdrop"
    class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden md:hidden"
    onclick="toggleSidebar()"
   ></div>

   <!-- Sidebar -->
   <aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-72 md:static md:w-80 border-r border-gray-200 flex flex-col p-6 bg-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out"
   >
    <div class="mb-10">
     <img
      alt="Company logo with blue wave icon"
      class="w-12 h-12"
      height="48"
      src="https://storage.googleapis.com/a1aa/image/6c4c8205-51d8-4f5d-380d-392eb2e4959c.jpg"
      width="48"
     />
    </div>
    <nav class="flex flex-col space-y-5 text-base font-semibold">
     <a
      class="flex items-center space-x-3 text-indigo-600 bg-indigo-50 rounded-md px-4 py-3"
      href="#">
      <i class="fas fa-home text-indigo-600 text-xl"></i>
      <span>Dashboard</span>
     </a>
     <a
        class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 px-4 py-3"
        href="#"
        >
        <i class="fas fa-users text-gray-400 text-xl"></i>
        <span>Users</span>
        </a>
     <div>
      <button
       aria-expanded="false"
       aria-controls="training-menu"
       class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 font-semibold w-full px-4 py-3 rounded-md focus:outline-none"
       type="button"
       onclick="toggleMenu('training-menu')"
      >
       <i class="fas fa-chalkboard-teacher text-gray-400 text-xl"></i>
       <span>Training</span>
       <i
        class="fas fa-chevron-down ml-auto text-gray-400 text-sm transition-transform duration-200"
        id="training-menu-icon"
       ></i>
      </button>
      <nav
       class="ml-10 mt-2 flex flex-col space-y-2 text-gray-600 text-base hidden"
       id="training-menu"
      >
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Training
       </a>
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Training Transaction
       </a>
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Training Ticket
       </a>
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Trainee
       </a>
      </nav>
     </div>
     <div>
      <button
       aria-expanded="false"
       aria-controls="product-menu"
       class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 font-semibold w-full px-4 py-3 rounded-md focus:outline-none"
       type="button"
       onclick="toggleMenu('product-menu')"
      >
       <i class="fas fa-box-open text-gray-400 text-xl"></i>
       <span>Product</span>
       <i
        class="fas fa-chevron-down ml-auto text-gray-400 text-sm transition-transform duration-200"
        id="product-menu-icon"
       ></i>
      </button>
      <nav
       class="ml-10 mt-2 flex flex-col space-y-2 text-gray-600 text-base hidden"
       id="product-menu"
      >
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Products
       </a>
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Product Transaction
       </a>
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Customer
       </a>
       <a
        class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
        href="#"
       >
        Product Order
       </a>
      </nav>
     </div>
    </nav>
    <div class="mt-auto pt-6 border-t border-gray-200">
     <button
      class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 font-semibold text-base w-full px-4 py-3 rounded-md"
      type="button"
     >
      <i class="fas fa-cog text-gray-400 text-xl"></i>
      <span>Settings</span>
     </button>
    </div>
   </aside>

   <!-- Main content -->
   <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
    <!-- Top bar -->
    <header
     class="flex items-center justify-between px-4 sm:px-6 py-5 border-b border-gray-200"
    >
     <div class="flex items-center space-x-4 w-full">
      <button
       id="sidebar-toggle"
       aria-label="Toggle sidebar"
       class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-2 flex-shrink-0"
       type="button"
       onclick="toggleSidebar()"
      >
       <i class="fas fa-bars text-2xl"></i>
      </button>
      <form class="flex items-center flex-grow max-w-full">
       <label class="sr-only" for="search">Search</label>
       <div class="relative w-full">
        <div
         class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400"
        >
         <i class="fas fa-search text-lg"></i>
        </div>
        <input
         class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-md text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
         id="search"
         placeholder="Search"
         type="search"
        />
       </div>
      </form>
     </div>
     <div class="flex items-center space-x-8 ml-8">
      <button
       aria-label="Notifications"
       class="text-gray-400 hover:text-gray-600 focus:outline-none"
       type="button"
      >
       <i class="far fa-bell text-2xl"></i>
      </button>
      <div class="border-l border-gray-200 h-7"></div>
      <button
       aria-expanded="false"
       aria-haspopup="true"
       class="flex items-center space-x-3 focus:outline-none"
       type="button"
      >
       <img
        alt="Profile picture of Tom Cook, a bald man with glasses"
        class="w-10 h-10 rounded-full"
        height="40"
        src="https://storage.googleapis.com/a1aa/image/3a25fdab-0611-4705-1b64-440e5835859d.jpg"
        width="40"
       />
       <span class="font-semibold text-gray-900 text-base">Hiseagully</span>
       <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
      </button>
     </div>
    </header>
    <!-- Content area -->
    <section class="flex-1 p-6">
     <div
      class="w-full h-[400px] rounded-lg border border-gray-300 bg-white bg-[repeating-linear-gradient(45deg,#f9fafb,#f9fafb_10px,#f3f4f6_10px,#f3f4f6_20px)]"
     ></div>
    </section>
   </main>
  </div>
  <script>
   // Sidebar toggle for mobile
   function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const backdrop = document.getElementById("sidebar-backdrop");
    sidebar.classList.toggle("-translate-x-full");
    backdrop.classList.toggle("hidden");
   }

   // Toggle menus and rotate arrow icons
   function toggleMenu(menuId) {
    const menu = document.getElementById(menuId);
    const icon = document.getElementById(menuId + "-icon");
    if (menu.classList.contains("hidden")) {
     menu.classList.remove("hidden");
     icon.classList.add("rotate-180");
    } else {
     menu.classList.add("hidden");
     icon.classList.remove("rotate-180");
    }
   }
  </script>
 </body>
</html>