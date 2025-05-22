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
     <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-semibold">Training Transactions</h2>
     </div>
     <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
       <thead>
        <tr class="bg-gray-100 text-gray-700">
         <th class="py-3 px-4 border-b text-center">No</th>
         <th class="py-3 px-4 border-b text-left">User</th>
         <th class="py-3 px-4 border-b text-left">Training Title</th>
         <th class="py-3 px-4 border-b text-left">Region</th>
         <th class="py-3 px-4 border-b text-center">Price (Rp)</th>
         <th class="py-3 px-4 border-b text-center">Status</th>
         <th class="py-3 px-4 border-b text-center">Actions</th>
        </tr>
       </thead>
       <tbody>
        @foreach($transactions as $trx)
        <tr class="hover:bg-gray-50">
         <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
         <td class="py-2 px-4 border-b">{{ $trx->user->name ?? '-' }}</td>
         <td class="py-2 px-4 border-b">{{ $trx->training->trainingtitle ?? '-' }}</td>
         <td class="py-2 px-4 border-b">{{ $trx->training->region->trainingregionname ?? '-' }}</td>
         <td class="py-2 px-4 border-b text-center">{{ $trx->training->trainingpricerupiah ?? '-' }}</td>
         <td class="py-2 px-4 border-b text-center">{{ $trx->status ?? '-' }}</td>
         <td class="py-2 px-4 border-b text-center">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-2">
           <i class="fas fa-eye"></i> Detail
          </button>
          <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
           <i class="fas fa-trash"></i> Hapus
          </button>
         </td>
        </tr>
        @endforeach
       </tbody>
      </table>
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
 </body>
</html>