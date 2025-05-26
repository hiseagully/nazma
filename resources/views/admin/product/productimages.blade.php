<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Product Images</title>
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
     <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-semibold">Product Images</h2>
      <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
        + Add Image
      </button>
     </div>
     <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
       <thead>
        <tr class="bg-gray-100 text-gray-700">
         <th class="py-3 px-4 border-b text-center w-16">No</th>
         <th class="py-3 px-4 border-b text-center">Product</th>
         <th class="py-3 px-4 border-b text-center">Image</th>
         <th class="py-3 px-4 border-b text-center">Thumbnail</th>
         <th class="py-3 px-4 border-b text-center">Actions</th>
        </tr>
       </thead>
       <tbody>
        @forelse($images as $img)
        <tr class="hover:bg-gray-50">
         <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
         <td class="py-2 px-4 border-b text-center">{{ $img->product->productname ?? '-' }}</td>
         <td class="py-2 px-4 border-b text-center">
          <img src="{{ asset('storage/' . $img->image_path) }}" alt="Image" class="h-16 mx-auto rounded">
         </td>
         <td class="py-2 px-4 border-b text-center">
          @if($img->is_thumbnail)
            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Thumbnail</span>
          @else
            <form action="{{ route('productimages.setThumbnail', $img->productimageid) }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="text-blue-500 hover:underline text-xs">Set as Thumbnail</button>
            </form>
          @endif
         </td>
         <td class="py-2 px-4 border-b flex justify-center gap-2 text-center">
          <form action="{{ route('productimages.destroy', $img->productimageid) }}" method="POST" onsubmit="return confirm('Delete this image?')" class="inline">
           @csrf
           @method('DELETE')
           <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm flex items-center">
            <i class="fas fa-trash mr-1"></i> Delete
           </button>
          </form>
         </td>
        </tr>
        @empty
        <tr>
         <td colspan="5" class="text-center text-gray-500">No images found.</td>
        </tr>
        @endforelse
       </tbody>
      </table>
     </div>
    </section>
   </main>
  </div>
  <!-- Add Image Modal -->
  <div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden" style="padding-top: 60px;">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[90vh]">
      <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
      <h3 class="text-lg font-semibold mb-4">Add Product Image</h3>
      <form action="{{ route('productimages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label class="block text-sm mb-1">Product</label>
          <select name="productid" class="border rounded px-3 py-2 w-full" required>
            <option value="">-- Select Product --</option>
            @foreach($products as $product)
              <option value="{{ $product->productid }}">{{ $product->productname }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-sm mb-1">Image</label>
          <input type="file" name="image_path" accept="image/*" class="border rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4 flex items-center">
          <input type="checkbox" name="is_thumbnail" id="is_thumbnail" value="1" class="mr-2">
          <label for="is_thumbnail" class="text-sm">Set as Thumbnail</label>
        </div>
        <div class="flex justify-end">
          <button type="button" onclick="closeAddModal()" class="mr-2 px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white">Add</button>
        </div>
      </form>
    </div>
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
   // Modal Add Image
   function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
   }
   function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
   }
  </script>
 </body>
</html>