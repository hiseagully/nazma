<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Product Collection</title>
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
     <div class="container mt-4">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Product Collection</h2>
        <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
            + Add Product
        </button>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-3 px-6 border-b text-center w-16">No</th>
                    <th class="py-3 px-6 border-b text-center">Catalog</th>
                    <th class="py-3 px-6 border-b text-center">Region</th>
                    <th class="py-3 px-6 border-b text-center">Name</th>
                    <th class="py-3 px-6 border-b text-center">Description</th>
                    <th class="py-3 px-6 border-b text-center">Price (Rp)</th>
                    <th class="py-3 px-6 border-b text-center">Price ($)</th>
                    <th class="py-3 px-6 border-b text-center">Weight (kg)</th>
                    <th class="py-3 px-6 border-b text-center">Stock</th>
                    <th class="py-3 px-6 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-6 border-b text-center">{{ $loop->iteration }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->catalog->productcatalogname ?? '-' }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->region->productregionsname ?? '-' }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->productname }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->productdescription }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ number_format($product->productpricerupiah, 0, ',', '.') }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->productpricedollar }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->productweight }}</td>
                    <td class="py-2 px-6 border-b text-center">{{ $product->productstock }}</td>
                    <td class="py-2 px-6 border-b text-center">
                      <div class="flex justify-center gap-2">
                        <!-- Tombol Edit -->
                        <button
                          class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm flex items-center"
                          data-id="{{ $product->productid }}"
                          data-catalog="{{ $product->productcatalogid }}"
                          data-region="{{ $product->productregionsid }}"
                          data-name="{{ addslashes($product->productname) }}"
                          data-description="{{ addslashes($product->productdescription) }}"
                          data-pricerupiah="{{ $product->productpricerupiah }}"
                          data-pricedollar="{{ $product->productpricedollar }}"
                          data-weight="{{ $product->productweight }}"
                          data-stock="{{ $product->productstock }}"
                          onclick="openEditModal(this)"
                        >
                          <i class="fas fa-edit mr-1"></i> Edit
                        </button>

                        <!-- Form Delete -->
                        <form
                          action="{{ route('productcollection.destroy', ['productcollection' => $product->productid]) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this product?')"
                          class="inline"
                        >
                          @csrf
                          @method('DELETE')
                          <button
                            type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm flex items-center"
                          >
                            <i class="fas fa-trash mr-1"></i> Delete
                          </button>
                        </form>
                      </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-gray-500">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden" style="padding-top:18vh; padding-bottom:5vh;">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative max-h-[75vh] overflow-y-auto mt-auto mb-0">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
        <h3 class="text-lg font-semibold mb-4">Add Product</h3>
        <form action="{{ route('productcollection.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="block mb-1 font-medium">Catalog</label>
            <select name="productcatalogid" class="w-full border rounded px-3 py-2" required>
              <option value="">-- Select Catalog --</option>
              @foreach(App\Models\ProductCatalog::all() as $cat)
                <option value="{{ $cat->productcatalogid }}">{{ $cat->productcatalogname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Region</label>
            <select name="productregionsid" class="w-full border rounded px-3 py-2" required>
              <option value="">-- Select Region --</option>
              @foreach(App\Models\ProductRegionsMap::all() as $reg)
                <option value="{{ $reg->productregionsid }}">{{ $reg->productregionsname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="productname" class="w-full border rounded px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="productdescription" class="w-full border rounded px-3 py-2"></textarea>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Price (Rp)</label>
            <input type="number" name="productpricerupiah" class="w-full border rounded px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Price ($)</label>
            <input type="number" step="0.01" name="productpricedollar" class="w-full border rounded px-3 py-2">
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Weight (kg)</label>
            <input type="number" step="0.01" name="productweight" class="w-full border rounded px-3 py-2">
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Stock</label>
            <input type="number" name="productstock" class="w-full border rounded px-3 py-2" required>
          </div>
          <div class="flex justify-end gap-2 mt-4">
            <button type="button" onclick="closeAddModal()" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white">Save</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden" style="padding-top:18vh; padding-bottom:5vh;">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative max-h-[75vh] overflow-y-auto mt-auto mb-0">
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
        <h3 class="text-lg font-semibold mb-4">Edit Product</h3>
        <form id="editProductForm" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input type="hidden" name="productid" id="edit_productid">
          <div class="mb-3">
            <label class="block mb-1 font-medium">Catalog</label>
            <select name="productcatalogid" id="edit_productcatalogid" class="w-full border rounded px-3 py-2" required>
              <option value="">-- Select Catalog --</option>
              @foreach(App\Models\ProductCatalog::all() as $cat)
                <option value="{{ $cat->productcatalogid }}">{{ $cat->productcatalogname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Region</label>
            <select name="productregionsid" id="edit_productregionid" class="w-full border rounded px-3 py-2" required>
              <option value="">-- Select Region --</option>
              @foreach(App\Models\ProductRegionsMap::all() as $reg)
                <option value="{{ $reg->productregionsid }}">{{ $reg->productregionsname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="productname" id="edit_productname" class="w-full border rounded px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="productdescription" id="edit_productdescription" class="w-full border rounded px-3 py-2"></textarea>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Price (Rp)</label>
            <input type="number" name="productpricerupiah" id="edit_productpricerupiah" class="w-full border rounded px-3 py-2" required>
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Price ($)</label>
            <input type="number" step="0.01" name="productpricedollar" id="edit_productpricedollar" class="w-full border rounded px-3 py-2">
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Weight (kg)</label>
            <input type="number" step="0.01" name="productweight" id="edit_productweight" class="w-full border rounded px-3 py-2">
          </div>
          <div class="mb-3">
            <label class="block mb-1 font-medium">Stock</label>
            <input type="number" name="productstock" id="edit_productstock" class="w-full border rounded px-3 py-2" required>
          </div>
          <div class="flex justify-end gap-2 mt-4">
            <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white">Update</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      function openAddModal() {
        document.getElementById('addProductModal').classList.remove('hidden');
      }
      function closeAddModal() {
        document.getElementById('addProductModal').classList.add('hidden');
      }
      function openEditModal(btn) {
        var modal = document.getElementById('editProductModal');
        document.getElementById('edit_productid').value = btn.getAttribute('data-id');
        document.getElementById('edit_productcatalogid').value = btn.getAttribute('data-catalog');
        document.getElementById('edit_productregionid').value = btn.getAttribute('data-region');
        document.getElementById('edit_productname').value = btn.getAttribute('data-name');
        document.getElementById('edit_productdescription').value = btn.getAttribute('data-description');
        document.getElementById('edit_productpricerupiah').value = btn.getAttribute('data-pricerupiah');
        document.getElementById('edit_productpricedollar').value = btn.getAttribute('data-pricedollar');
        document.getElementById('edit_productweight').value = btn.getAttribute('data-weight');
        document.getElementById('edit_productstock').value = btn.getAttribute('data-stock');
        // Gunakan route helper agar URL benar
        var actionUrl = "{{ url('/admin/product/productcollection') }}/" + btn.getAttribute('data-id');
        document.getElementById('editProductForm').action = actionUrl;
        modal.classList.remove('hidden');
      }
      function closeEditModal() {
        document.getElementById('editProductModal').classList.add('hidden');
      }
    </script>
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