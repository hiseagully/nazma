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
     @php
    $user = Auth::user();
    // Ambil provinsi dan kota dari district_name jika ada
    $province = $user->district_name ? trim(explode(',', $user->district_name)[0]) : '-';
    $city = $user->district_name ? trim(explode(',', $user->district_name)[1] ?? '-') : '-';
   @endphp
     <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200 max-w-lg">
      <h3 class="font-semibold mb-3 text-lg">Customer Data</h3>
      <div class="mb-2"><strong>Email</strong><br>{{ $user->user_email ?? '-' }}</div>
      <div class="mb-2"><strong>Name</strong><br>{{ $user->user_name ?? '-' }}</div>
      <div class="mb-2"><strong>Phone Number</strong><br>{{ $user->user_phone ?? '-' }}</div>
      <div class="mb-2"><strong>Country</strong><br>{{ $user->country_name ?? '-' }}</div>
      <div class="mb-2"><strong>International</strong><br>{{ $user->country_code && $user->country_code != 'ID' ? 'Yes' : 'No' }}</div>
      <div class="mb-2"><strong>Provinsi</strong><br>{{ $province }}</div>
      <div class="mb-2"><strong>Kabupaten/Kota</strong><br>{{ $city }}</div>
      <div class="mb-2"><strong>Full Address</strong><br>{{ $user->full_address ?? '-' }}</div>
     </div>
     <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200 max-w-lg">
      <h3 class="font-semibold mb-3 text-lg">Admin/User Pembuat Produk</h3>
      @if(isset($admin))
        <div class="mb-2"><strong>Email</strong><br>{{ $admin->user_email ?? '-' }}</div>
        <div class="mb-2"><strong>Name</strong><br>{{ $admin->user_name ?? '-' }}</div>
        <div class="mb-2"><strong>Phone Number</strong><br>{{ $admin->user_phone ?? '-' }}</div>
        <div class="mb-2"><strong>Country</strong><br>{{ $admin->country_name ?? '-' }}</div>
        <div class="mb-2"><strong>Provinsi</strong><br>{{ $admin->district_name ? trim(explode(',', $admin->district_name)[0]) : '-' }}</div>
        <div class="mb-2"><strong>Kabupaten/Kota</strong><br>{{ $admin->district_name ? trim(explode(',', $admin->district_name)[1] ?? '-') : '-' }}</div>
        <div class="mb-2"><strong>Full Address</strong><br>{{ $admin->full_address ?? '-' }}</div>
      @else
        <div class="text-gray-500">Data admin/pembuat produk tidak tersedia.</div>
      @endif
     </div>
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