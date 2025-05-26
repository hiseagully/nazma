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
    use App\Models\User;
    $users = User::all();
@endphp
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead>
            <tr class="bg-gray-100 text-gray-700">
                <th class="py-3 px-6 border-b w-16">No</th>
                <th class="py-3 px-6 border-b">Name</th>
                <th class="py-3 px-6 border-b">Email</th>
                <th class="py-3 px-6 border-b">Phone</th>
                <th class="py-3 px-6 border-b">Role</th>
                <th class="py-3 px-4 border-b w-48">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="py-2 px-6 border-b text-center">{{ $loop->iteration }}</td>
                <td class="py-2 px-6 border-b text-center">{{ $user->user_name }}</td>
                <td class="py-2 px-6 border-b text-center">{{ $user->user_email }}</td>
                <td class="py-2 px-6 border-b text-center">{{ $user->user_phone }}</td>
                <td class="py-2 px-6 border-b text-center">{{ $user->role }}</td>
                <td class="py-2 px-4 border-b flex justify-center gap-2 text-center">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2"><i class="fas fa-edit"></i> Edit</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"><i class="fas fa-trash"></i> Hapus</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-2 px-4 text-gray-500 text-center">No users found.</td>
            </tr>
            @endforelse
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