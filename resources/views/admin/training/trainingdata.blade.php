<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Training Data Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
    <style>
        body { font-family: "Poppins", sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">
<div class="flex min-h-screen border border-gray-200">
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
            <div class="overflow-x-auto max-w-full">
                <table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg">
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
                            <th class="py-3 px-4 border-b text-center">Region</th>
                            <th class="py-3 px-4 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainings as $training)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $training->trainingtitle }}</td>
                            <td class="py-2 px-4 border-b align-top max-w-xs">
                                <div class="max-h-40 overflow-y-auto whitespace-pre-line" style="max-width: 250px;">
                                    {{ $training->trainingdescription }}
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->trainingpricerupiah }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ rtrim(rtrim($training->trainingpricedollar, '0'), '.') }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                @if($training->trainingimage)
                                    <img src="{{ asset('storage/training_images/' . $training->trainingimage) }}" alt="Training Image" class="w-16 h-10 object-cover rounded mx-auto" />
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->trainingschedule }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->traininglocation }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $training->trainingslot }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                {{ $training->region->trainingregionname ?? '-' }}
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm flex items-center"
                                        onclick='openEditModal(@json($training))'
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
        <h3 class="text-xl font-bold mb-4 text-[#FF7A00] flex items-center gap-2">Edit Training</h3>
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
                <div id="currentImagePreview" class="mb-2 hidden">
                    <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                    <img id="previewImage" src="{{ asset('storage/training_images/' . $training->trainingimage) }}" alt="Current Image" class="h-32 rounded mx-auto">
                </div>
                <input type="file" name="gambar" id="editGambar" accept="image/*" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Schedule</label>
                <input type="text" name="trainingschedule" id="editJadwal" class="border rounded px-3 py-2 w-full" placeholder="Schedule" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Location</label>
                <input type="text" name="traininglocation" id="editLokasi" class="border rounded px-3 py-2 w-full" placeholder="Location" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Slot</label>
                <input type="number" name="trainingslot" id="editSlot" class="border rounded px-3 py-2 w-full" placeholder="Slot" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1">Region</label>
                <select name="trainingregionid" class="border rounded px-3 py-2 w-full" required>
                    <option value="">-- Choose Region --</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->trainingid }}">{{ $region->trainingregionname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-right flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 rounded px-4 py-2 text-gray-700">Cancel</button>
                <button type="submit" class="bg-[#FF7A00] hover:bg-[#e57000] rounded px-4 py-2 text-white font-semibold">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 flex items-start justify-center bg-black bg-opacity-30 overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative mt-24 mb-8">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h3 class="text-xl font-bold mb-4 text-[#FF7A00] flex items-center gap-2">Add Training</h3>
        <form action="{{ route('admin.training.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="trainingtitle" class="border rounded px-3 py-2 w-full" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="trainingdescription" class="border rounded px-3 py-2 w-full" placeholder="Description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="trainingpricerupiah" class="border rounded px-3 py-2 w-full" placeholder="Harga (Rp)" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Harga ($)</label>
                <input type="number" step="0.01" name="trainingpricedollar" class="border rounded px-3 py-2 w-full" placeholder="Harga ($)" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Image</label>
                <input type="file" name="gambar" accept="image/*" class="border rounded px-3 py-2 w-full" required>
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
                    <option value="">-- Pilih Region --</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->trainingid }}">{{ $region->trainingregionname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-right">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 border rounded mr-2">Cancel</button>
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Add Training</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open Add Modal
    function openAddModal() {
        document.getElementById("addModal").classList.remove("hidden");
    }

    // Close Add Modal
    function closeAddModal() {
        document.getElementById("addModal").classList.add("hidden");
    }

    // Open Edit Modal
    function openEditModal(training) {
        document.getElementById("editModal").classList.remove("hidden");

        // Isi data ke dalam form
        document.getElementById("editId").value = training.trainingid;
        document.getElementById("editJudul").value = training.trainingtitle;
        document.getElementById("editDeskripsi").value = training.trainingdescription;
        document.getElementById("editHargaRp").value = training.trainingpricerupiah;
        document.getElementById("editHargaDollar").value = training.trainingpricedollar;
        document.getElementById("editJadwal").value = training.trainingschedule;
        document.getElementById("editLokasi").value = training.traininglocation;
        document.getElementById("editSlot").value = training.trainingslot;

        // Pilih region
        const regionSelect = document.querySelector('#editForm select[name="trainingregionid"]');
        regionSelect.value = training.trainingregionid;

        // Preview image jika ada
        const previewImage = document.getElementById("previewImage");
        const currentImagePreview = document.getElementById("currentImagePreview");

        if (training.trainingimage) {
            previewImage.src = `${window.location.origin}/storage/training_images/${training.trainingimage}`;
            currentImagePreview.classList.remove("hidden");
        } else {
            currentImagePreview.classList.add("hidden");
        }

        // Set action URL (editForm submit ke URL training yang sesuai)
        document.getElementById("editForm").action = `/admin/training/${training.trainingid}`;
    }

    // Close Edit Modal
    function closeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
    }
</script>

</body>
</html>
