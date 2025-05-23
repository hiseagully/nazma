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
   @include('components.adminsidebar')

   <!-- Main content -->
   <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
    <!-- Top bar -->
    @include('components.adminnavbar')
    <!-- Content area -->
    <section class="flex-1 p-6">

    </section>
    <main class="flex-1 p-8">
     <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Card: Total Products -->
      <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
       <h2 class="text-lg font-semibold mb-2">Total Products</h2>
       <div class="text-4xl font-bold text-orange-500 mb-2">120</div>
       <div class="w-full h-32">
        <canvas id="productsChart"></canvas>
       </div>
      </div>
      <!-- Card: Total Orders -->
      <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
       <h2 class="text-lg font-semibold mb-2">Total Orders</h2>
       <div class="text-4xl font-bold text-orange-500 mb-2">75</div>
       <div class="w-full h-32">
        <canvas id="ordersChart"></canvas>
       </div>
      </div>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
      <!-- Card: Total Customers -->
      <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
       <h2 class="text-lg font-semibold mb-2">Total Customers</h2>
       <div class="text-4xl font-bold text-orange-500 mb-2">42</div>
       <div class="w-full h-32">
        <canvas id="customersChart"></canvas>
       </div>
      </div>
      <!-- Card: Total Regions -->
      <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
       <h2 class="text-lg font-semibold mb-2">Total Regions</h2>
       <div class="text-4xl font-bold text-orange-500 mb-2">8</div>
       <div class="w-full h-32">
        <canvas id="regionsChart"></canvas>
       </div>
      </div>
     </div>
    </main>
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
   // Statis data
   const productsChart = new Chart(document.getElementById('productsChart'), {
    type: 'bar',
    data: {
     labels: ['Aksesoris', 'Fashion', 'Kerajinan', 'Lainnya'],
     datasets: [{
      label: 'Jumlah',
      data: [40, 30, 25, 25],
      backgroundColor: '#FFB366',
     }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
   });
   const ordersChart = new Chart(document.getElementById('ordersChart'), {
    type: 'line',
    data: {
     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
     datasets: [{
      label: 'Order',
      data: [10, 15, 20, 18, 12],
      borderColor: '#FF7A00',
      backgroundColor: 'rgba(255,122,0,0.1)',
      fill: true,
      tension: 0.4
     }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
   });
   const customersChart = new Chart(document.getElementById('customersChart'), {
    type: 'doughnut',
    data: {
     labels: ['Aktif', 'Nonaktif'],
     datasets: [{
      data: [30, 12],
      backgroundColor: ['#FFB366', '#FFE0CC'],
     }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
   });
   const regionsChart = new Chart(document.getElementById('regionsChart'), {
    type: 'pie',
    data: {
     labels: ['Jawa', 'Sumatera', 'Kalimantan', 'Sulawesi'],
     datasets: [{
      data: [3, 2, 2, 1],
      backgroundColor: ['#FFB366', '#FF7A00', '#FFE0CC', '#FFD6A0'],
     }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
   });
  </script>
  <x-footer></x-footer>
 </body>
</html>