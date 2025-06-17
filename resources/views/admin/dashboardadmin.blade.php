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
   .dashboard-card {
    transition: box-shadow 0.2s, transform 0.2s;
   }
   .dashboard-card:hover {
    box-shadow: 0 8px 32px 0 rgba(255, 122, 0, 0.1),
     0 1.5px 4px 0 rgba(0, 0, 0, 0.04);
    transform: translateY(-4px) scale(1.03);
   }
  </style>
 </head>
 <body class="bg-[#f8fafc] text-gray-900">
  <div class="flex min-h-screen border border-gray-200">
   <!-- Sidebar backdrop for mobile -->
   <div
    id="sidebar-backdrop"
    class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden md:hidden"
    onclick="toggleSidebar()"
   ></div>

   <!-- Sidebar -->
   @include('components.adminsidebar')

   <!-- Main content -->
   <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
    <!-- Top bar -->
    @include('components.adminnavbar')
    <!-- Content area -->
    <section class="flex-1 p-6">
     <h1 class="text-2xl font-bold mb-8">Admin Dashboard</h1>
     <!-- Baris 1: 3 Card -->
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
      <!-- Card: Total Products -->
      <div class="dashboard-card bg-gradient-to-br from-orange-100 to-orange-50 rounded-xl shadow p-6 flex flex-col items-center">
       <div class="bg-orange-500 text-white rounded-full p-3 mb-3">
        <i class="fas fa-box text-2xl"></i>
       </div>
       <h2 class="text-base font-semibold mb-1 text-gray-700">Total Products</h2>
       <div class="text-3xl font-bold text-orange-500 mb-1">
        {{ $totalProducts }}
       </div>
      </div>
      <!-- Card: Total Trainings -->
      <div class="dashboard-card bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl shadow p-6 flex flex-col items-center">
       <div class="bg-blue-500 text-white rounded-full p-3 mb-3">
        <i class="fas fa-chalkboard-teacher text-2xl"></i>
       </div>
       <h2 class="text-base font-semibold mb-1 text-gray-700">Total Trainings</h2>
       <div class="text-3xl font-bold text-blue-500 mb-1">
        {{ $totalTrainings }}
       </div>
      </div>
      <!-- Card: Total Customers -->
      <div class="dashboard-card bg-gradient-to-br from-green-100 to-green-50 rounded-xl shadow p-6 flex flex-col items-center">
       <div class="bg-green-500 text-white rounded-full p-3 mb-3">
        <i class="fas fa-users text-2xl"></i>
       </div>
       <h2 class="text-base font-semibold mb-1 text-gray-700">Total Customers</h2>
       <div class="text-3xl font-bold text-green-500 mb-1">
        {{ $totalCustomers }}
       </div>
      </div>
     </div>
     <!-- Baris 2: 2 Card -->
     <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <!-- Card: Total Regions -->
      <div class="dashboard-card bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl shadow p-6 flex flex-col items-center">
       <div class="bg-purple-500 text-white rounded-full p-3 mb-3">
        <i class="fas fa-map-marker-alt text-2xl"></i>
       </div>
       <h2 class="text-base font-semibold mb-1 text-gray-700">Total Regions</h2>
       <div class="text-3xl font-bold text-purple-500 mb-1">
        {{ $totalRegions }}
       </div>
      </div>
      <!-- Card: Total Product Categories -->
      <div class="dashboard-card bg-gradient-to-br from-pink-100 to-pink-50 rounded-xl shadow p-6 flex flex-col items-center">
       <div class="bg-pink-500 text-white rounded-full p-3 mb-3">
        <i class="fas fa-tags text-2xl"></i>
       </div>
       <h2 class="text-base font-semibold mb-1 text-gray-700">Total Product Categories</h2>
       <div class="text-3xl font-bold text-pink-500 mb-1">
        {{ $productCategories->count() }}
       </div>
      </div>
     </div>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
   // Data dari backend
   const productsChart = new Chart(document.getElementById('productsChart'), {
    type: 'bar',
    data: {
     labels: {!! json_encode(array_keys($productsByCategory->toArray())) !!},
     datasets: [{
      label: 'Jumlah',
      data: {!! json_encode(array_values($productsByCategory->toArray())) !!},
      backgroundColor: '#FFB366',
     }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
   });
   const customersChart = new Chart(document.getElementById('customersChart'), {
    type: 'doughnut',
    data: {
     labels: {!! json_encode(array_keys($customersStatus)) !!},
     datasets: [{
      data: {!! json_encode(array_values($customersStatus)) !!},
      backgroundColor: ['#FFB366', '#FFE0CC'],
     }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
   });
   // Regions chart kecil (di atas)
   const regionsChart = new Chart(document.getElementById('regionsChart'), {
    type: 'pie',
    data: {
     labels: {!! json_encode(array_keys($regionsByIsland->toArray())) !!},
     datasets: [{
      data: {!! json_encode(array_values($regionsByIsland->toArray())) !!},
      backgroundColor: ['#FFB366', '#FF7A00', '#FFE0CC', '#FFD6A0'],
     }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
   });
   // Regions chart besar (di samping Product Categories)
   const regionsChartBig = new Chart(document.getElementById('regionsChartBig'), {
    type: 'pie',
    data: {
     labels: {!! json_encode(array_keys($regionsByIsland->toArray())) !!},
     datasets: [{
      data: {!! json_encode(array_values($regionsByIsland->toArray())) !!},
      backgroundColor: ['#FFB366', '#FF7A00', '#FFE0CC', '#FFD6A0'],
     }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
   });
  </script>
  <x-footer></x-footer>
 </body>
</html>