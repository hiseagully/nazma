<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Product Catalog Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: "Poppins", sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">
<div class="flex min-h-screen border border-gray-200">
    <!-- Sidebar backdrop for mobile -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>
    <!-- Sidebar -->
    <x-adminsidebar :activeMenu="'product'" :activeSubMenu="'productcatalog'" />
    <!-- Main content -->
    <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
        <!-- Top bar -->
        @include('components.adminnavbar')
        <!-- Content area -->
        <section class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Product Catalog</h2>
                <!-- Tombol Add Product -->
                <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
                    + Add Product
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-6 border-b text-center w-16">No</th>
                            <th class="py-3 px-6 border-b text-center">Catalog Name</th>
                            <th class="py-3 px-6 border-b text-center">Image</th>
                            <th class="py-3 px-4 border-b text-center w-48">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productcatalogs as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-6 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-6 border-b text-center">{{ $product->productcatalogname }}</td>
                            <td class="py-2 px-6 border-b text-center">
                                @if($product->productcatalogimage)
                                    <img src="{{ asset('storage/' . $product->productcatalogimage) }}" alt="Image" class="h-12 mx-auto rounded">
                                @else
                                    <span class="text-gray-400">No image</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b flex justify-center gap-2 text-center">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm flex items-center"
                                    onclick="openEditModal({{ $product->productcatalogid }}, '{{ addslashes($product->productcatalogname) }}', '{{ addslashes($product->productcatalogimage) }}')"
                                >
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <form action="{{ route('productcatalog.destroy', ['productcatalog' => $product->productcatalogid]) }}" method="POST" onsubmit="return confirm('Delete this product?')" class="inline">
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
                            <td colspan="4" class="py-2 px-4 text-gray-500 text-center">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h3 class="text-lg font-semibold mb-4">Edit Product</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="productcatalogid" id="editProductId">
            <div class="mb-4">
                <label class="block text-sm mb-1">Catalog Name</label>
                <input type="text" name="productcatalogname" id="editProductName" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Current Image</label>
                <div id="editImagePreview" class="mb-2"></div>
                <label class="block text-sm mb-1">Change Image</label>
                <input type="file" name="productcatalogimage" id="editProductImage" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h3 class="text-lg font-semibold mb-4">Add Product</h3>
        <form action="{{ route('productcatalog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm mb-1">Catalog Name</label>
                <input type="text" name="productcatalogname" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">Image</label>
                <input type="file" name="productcatalogimage" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeAddModal()" class="mr-2 px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white">Add</button>
            </div>
        </form>
    </div>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const backdrop = document.getElementById("sidebar-backdrop");
        sidebar.classList.toggle("-translate-x-full");
        backdrop.classList.toggle("hidden");
    }
    function openEditModal(id, name, image) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editProductId').value = id;
        document.getElementById('editProductName').value = name;
        // Show current image preview
        var preview = document.getElementById('editImagePreview');
        if(image) {
            preview.innerHTML = '<img src="' + (image.startsWith('http') ? image : '/storage/' + image) + '" class="h-12 rounded"/>';
        } else {
            preview.innerHTML = '<span class="text-gray-400">No image</span>';
        }
        document.getElementById('editForm').action = '/admin/product/productcatalog/' + id;
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }
    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }
</script>
<x-footer></x-footer>
</body>
</html>
