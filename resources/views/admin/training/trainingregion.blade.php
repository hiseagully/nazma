<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Training Region Admin</title>
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
    <x-adminsidebar :activeMenu="'training'" :activeSubMenu="'trainingregion'" />
    <!-- Main content -->
    <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
        <!-- Top bar -->
        @include('components.adminnavbar')
        <!-- Content area -->
        <section class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Training Region Management</h2>
                <!-- Tombol Add Region -->
                <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
                    + Add Region
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-6 border-b text-center w-16">No</th>
                            <th class="py-3 px-6 border-b text-left">Region Name</th>
                            <th class="py-3 px-4 border-b text-center w-48">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($regions as $region)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-6 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-6 border-b">{{ $region->trainingregionname }}</td>
                            <td class="py-2 px-4 border-b flex justify-center gap-2 text-center">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm flex items-center"
                                    onclick="openEditModal({{ $region->trainingid }}, '{{ addslashes($region->trainingregionname) }}')"
                                >
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <form action="{{ route('admin.trainingregion.destroy', $region->trainingid) }}" method="POST" onsubmit="return confirm('Delete this region?')" class="inline">
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
                            <td colspan="3" class="py-2 px-4 text-gray-500 text-center">No regions found.</td>
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
        <h3 class="text-lg font-semibold mb-4">Edit Region</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="trainingid" id="editRegionId">
            <input type="text" name="trainingregionname" id="editRegionName" class="border rounded px-3 py-2 w-full mb-4" required>
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
        <h3 class="text-lg font-semibold mb-4">Add Region</h3>
        <form action="{{ route('admin.trainingregion.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="New Region Name" class="border rounded px-3 py-2 w-full mb-4" required>
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
    function openEditModal(id, name) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editRegionId').value = id;
        document.getElementById('editRegionName').value = name;
        // Set form action dynamically
        document.getElementById('editForm').action = '/trainingregion/' + id;
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