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
     <!-- Tabel User dengan aksi Edit dan Hapus -->
     <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
       <thead>
        <tr class="bg-gray-100 text-gray-700">
         <th class="py-3 px-4 border-b text-left">Nama</th>
         <th class="py-3 px-4 border-b text-left">Email</th>
         <th class="py-3 px-4 border-b text-left">No HP</th>
         <th class="py-3 px-4 border-b text-left">Aksi</th>
        </tr>
       </thead>
       <tbody>
        <tr>
         <td class="py-2 px-4 border-b">John Doe</td>
         <td class="py-2 px-4 border-b">john@example.com</td>
         <td class="py-2 px-4 border-b">08123456789</td>
         <td class="py-2 px-4 border-b">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2"><i class="fas fa-edit"></i> Edit</button>
          <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"><i class="fas fa-trash"></i> Hapus</button>
         </td>
        </tr>
        <tr>
         <td class="py-2 px-4 border-b">Jane Smith</td>
         <td class="py-2 px-4 border-b">jane@example.com</td>
         <td class="py-2 px-4 border-b">08987654321</td>
         <td class="py-2 px-4 border-b">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2"><i class="fas fa-edit"></i> Edit</button>
          <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"><i class="fas fa-trash"></i> Hapus</button>
         </td>
        </tr>
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