<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Training Data Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>
        body { font-family: "Poppins", sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">
<div class="flex min-h-screen border border-gray-200">
    <!-- Sidebar backdrop for mobile -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>
    <!-- Sidebar -->
    <x-adminsidebar :activeMenu="'training'" :activeSubMenu="'training'" />
    <!-- Main content -->
    <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
        <!-- Top bar -->
        @include('components.adminnavbar')
        <!-- Content area -->
        <section class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Training Data Management</h2>
                <!-- Tombol Add Training -->
                <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
                    + Add Training
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-4 border-b text-center">No</th>
                            <th class="py-3 px-4 border-b text-left">Title</th>
                            <th class="py-3 px-4 border-b text-left">Description</th>
                            <th class="py-3 px-4 border-b text-center">Price (Rp)</th>
                            <th class="py-3 px-4 border-b text-center">Price ($)</th>
                            <th class="py-3 px-4 border-b text-center">Image</th>
                            <th class="py-3 px-4 border-b text-center">Schedule</th>
                            <th class="py-3 px-4 border-b text-center">Location</th>
                            <th class="py-3 px-4 border-b text-center">Slot</th>
                            <th class="py-3 px-4 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainings as $training)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $training->trainingtitle }}</td>
                            <td class="py-2 px-4 border-b align-top max-w-md">
                                <div class="max-h-40 overflow-y-auto whitespace-pre-line" style="max-width:350px;">
                                    {{ $training->trainingdescription }}
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->trainingpricerupiah }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ rtrim(rtrim($training->trainingpricedollar, '0'), '.') }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                @if($training->trainingimage)
                                    <img src="{{ $training->trainingimage }}" class="w-16 h-10 object-cover rounded mx-auto" />
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->trainingschedule }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->traininglocation }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->trainingslot }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm flex items-center"
                                        onclick="openEditModal(
                                            {{ $training->trainingid }},
                                            '{{ addslashes($training->trainingtitle) }}',
                                            '{{ base64_encode($training->trainingdescription) }}',
                                            '{{ $training->trainingpricerupiah }}',
                                            '{{ $training->trainingpricedollar }}',
                                            '{{ addslashes($training->trainingimage) }}',
                                            '{{ $training->trainingschedule }}',
                                            '{{ $training->traininglocation }}',
                                            '{{ $training->trainingslot }}'
                                        )"
                                    >
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                    <form action="{{ route('trainingprogram.destroy', $training->trainingid) }}" method="POST" onsubmit="return confirm('Delete this training?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm flex items-center">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 flex items-start justify-center bg-black bg-opacity-30 overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative mt-24 mb-8">
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h3  class="text-xl font-bold mb-4 text-[#FF7A00] flex items-center gap-2">Edit Training</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="trainingtitle" id="editJudul" class="border rounded px-3 py-2 w-full" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="trainingdescription" id="editDeskripsi" class="border rounded px-3 py-2 w-full" placeholder="Description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="trainingpricerupiah" id="editHargaRp" class="border rounded px-3 py-2 w-full" placeholder="Harga (Rp)" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Harga ($)</label>
                <input type="number" step="0.01" name="trainingpricedollar" id="editHargaDollar" class="border rounded px-3 py-2 w-full" placeholder="Harga ($)" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Image</label>
                <input type="file" name="gambar" id="editGambar" accept="image/*" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Schedule</label>
                <input type="datetime-local" name="trainingschedule" id="editJadwal" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Location</label>
                <input type="text" name="traininglocation" id="editLokasi" class="border rounded px-3 py-2 w-full" placeholder="Location" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Slot</label>
                <input type="number" name="trainingslot" id="editSlot" class="border rounded px-3 py-2 w-full mb-4" placeholder="Slot" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 flex items-start justify-center bg-black bg-opacity-30 overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-8 relative mt-24 mb-8">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h3 class="text-xl font-bold mb-4 text-[#FF7A00] flex items-center gap-2">
            Add Training
        </h3>
        <form action="{{ route('trainingprogram.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="trainingtitle" class="border rounded px-3 py-2 w-full" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea class="h-24 overflow-auto w-full p-2 border rounded" name="trainingdescription" placeholder="Description" required></textarea>
            </div>
            <div class="mb-3 flex gap-2">
                <div class="w-1/2">
                    <label class="block text-sm font-semibold mb-1">Harga (Rp)</label>
                    <input type="number" name="trainingpricerupiah" class="border rounded px-3 py-2 w-full" placeholder="Harga (Rp)" required>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm font-semibold mb-1">Harga ($)</label>
                    <input type="number" step="0.01" name="trainingpricedollar" class="border rounded px-3 py-2 w-full" placeholder="Harga ($)" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Image</label>
                <input type="file" name="gambar" accept="image/*" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Schedule</label>
                <input type="datetime-local" name="trainingschedule" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Location</label>
                <input type="text" name="traininglocation" class="border rounded px-3 py-2 w-full" placeholder="Location" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Slot</label>
                <input type="number" name="trainingslot" class="border rounded px-3 py-2 w-full" placeholder="Slot" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Region</label>
                <select name="trainingregionid" class="border rounded px-3 py-2 w-full" required>
                    <option value="">Select Region</option>
                    @foreach(\App\Models\TrainingRegion::all() as $region)
                        <option value="{{ $region->trainingid }}">{{ $region->trainingregionname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeAddModal()" class="px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-1 rounded bg-[#FF7A00] hover:bg-orange-600 text-white font-semibold">Add</button>
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
    function openEditModal(id, title, descriptionBase64, priceRp, priceDollar, image, schedule, location, slot) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editJudul').value = title;
    document.getElementById('editDeskripsi').value = atob(descriptionBase64);
    document.getElementById('editHargaRp').value = priceRp;
    document.getElementById('editHargaDollar').value = priceDollar;
    document.getElementById('editJadwal').value = schedule;
    document.getElementById('editLokasi').value = location;
    document.getElementById('editSlot').value = slot;
    document.getElementById('editForm').action = '/trainingprogram/' + id;
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