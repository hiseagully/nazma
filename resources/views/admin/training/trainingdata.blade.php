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
                                        onclick="openEditModal({
                                            trainingid: {{ $training->trainingid }},
                                            trainingtitle: {{ json_encode($training->trainingtitle) }},
                                            trainingdescription: {{ json_encode($training->trainingdescription) }},
                                            trainingpricerupiah: {{ $training->trainingpricerupiah }},
                                            trainingpricedollar: {{ $training->trainingpricedollar }},
                                            trainingimage: {{ json_encode($training->trainingimage) }},
                                            trainingschedule: {{ json_encode($training->trainingschedule) }},
                                            traininglocation: {{ json_encode($training->traininglocation) }},
                                            trainingslot: {{ $training->trainingslot }},
                                            trainingregionid: {{ $training->trainingregionid ?? 'null' }}
                                        })"
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
                    <img id="previewImage" src="" alt="Current Image" class="h-32 rounded mx-auto">
                </div>
                <input type="file" name="gambar" id="editGambar" accept="image/*" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Schedule</label>
                <input type="datetime-local" name="trainingschedule" id="editJadwal" class="border rounded px-3 py-2 w-full" placeholder="Schedule" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Location</label>
                <input type="text" name="traininglocation" id="editLokasi" class="border rounded px-3 py-2 w-full" placeholder="Location" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Slot</label>
                <input type="number" name="trainingslot" id="editSlot" class="border rounded px-3 py-2 w-full" placeholder="Slot" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Region</label>
                <select name="trainingregionid" id="editRegion" class="border rounded px-3 py-2 w-full" required>
                    <option value="">-- Select Region --</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->trainingid }}">{{ $region->trainingregionname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="bg-[#FF7A00] hover:bg-orange-600 text-white rounded px-5 py-2 font-semibold text-sm">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 flex items-start justify-center bg-black bg-opacity-30 overflow-y-auto hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative mt-24 mb-8">
        <button onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h3 class="text-xl font-bold mb-4 text-[#FF7A00] flex items-center gap-2">Add Training</h3>
        <form id="addForm" method="POST" enctype="multipart/form-data" action="{{ route('trainingprogram.store') }}">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="trainingtitle" id="addJudul" class="border rounded px-3 py-2 w-full" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="trainingdescription" id="addDeskripsi" class="border rounded px-3 py-2 w-full" placeholder="Description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="trainingpricerupiah" id="addHargaRp" class="border rounded px-3 py-2 w-full" placeholder="Harga (Rp)" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Harga ($)</label>
                <input type="number" step="0.01" name="trainingpricedollar" id="addHargaDollar" class="border rounded px-3 py-2 w-full" placeholder="Harga ($)" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Image</label>
                <input type="file" name="gambar" id="addGambar" accept="image/*" class="border rounded px-3 py-2 w-full">
                <img id="addPreviewImage" class="mt-2 h-32 rounded hidden mx-auto" alt="Preview Image">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Schedule</label>
                <input type="datetime-local" name="trainingschedule" id="addJadwal" class="border rounded px-3 py-2 w-full" placeholder="Schedule" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Location</label>
                <input type="text" name="traininglocation" id="addLokasi" class="border rounded px-3 py-2 w-full" placeholder="Location" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Slot</label>
                <input type="number" name="trainingslot" id="addSlot" class="border rounded px-3 py-2 w-full" placeholder="Slot" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Region</label>
                <select name="trainingregionid" id="addRegion" class="border rounded px-3 py-2 w-full" required>
                    <option value="">-- Select Region --</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->trainingid }}">{{ $region->trainingregionname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-5 text-right">
                <button type="submit" class="bg-[#FF7A00] hover:bg-orange-600 text-white rounded px-5 py-2 font-semibold text-sm">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let editCKEditorReady = false;
    let addCKEditorReady = false;

    // Initialize CKEditor for edit modal
    CKEDITOR.replace('editDeskripsi', {
        height: 120,
        removePlugins: 'elementspath',
        resize_enabled: false
    });

    // Initialize CKEditor for add modal
    CKEDITOR.replace('addDeskripsi', {
        height: 120,
        removePlugins: 'elementspath',
        resize_enabled: false
    });

    // Check when CKEditor instances are ready
    CKEDITOR.instances['editDeskripsi'].on('instanceReady', function() {
        editCKEditorReady = true;
        console.log('Edit CKEditor ready');
    });

    CKEDITOR.instances['addDeskripsi'].on('instanceReady', function() {
        addCKEditorReady = true;
        console.log('Add CKEditor ready');
    });

    // Helper function to set CKEditor data
    function setEditCKEditorData(data) {
        const instance = CKEDITOR.instances['editDeskripsi'];
        if (instance) {
            if (instance.status === 'ready') {
                instance.setData(data || '');
                console.log('CKEditor data set immediately:', data);
            } else {
                instance.on('instanceReady', function() {
                    instance.setData(data || '');
                    console.log('CKEditor data set after ready:', data);
                });
            }
        }
    }

    // Function to format date for datetime-local input
    function formatDateForInput(dateString) {
        console.log('Original date string:', dateString);
        
        if (!dateString) return '';
        
        try {
            // Handle different date formats
            let date;
            if (dateString.includes('T')) {
                // ISO format: 2024-01-15T10:30:00
                date = new Date(dateString);
            } else if (dateString.includes(' ')) {
                // MySQL format: 2024-01-15 10:30:00
                date = new Date(dateString.replace(' ', 'T'));
            } else {
                date = new Date(dateString);
            }
            
            if (isNaN(date.getTime())) {
                console.error('Invalid date:', dateString);
                return '';
            }
            
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            
            const formatted = `${year}-${month}-${day}T${hours}:${minutes}`;
            console.log('Formatted date:', formatted);
            return formatted;
        } catch (error) {
            console.error('Error formatting date:', error);
            return '';
        }
    }

    // Modal Edit
    function openEditModal(training) {
        console.log('=== OPENING EDIT MODAL ===');
        console.log('Full training data:', training);
        
        // Show modal
        document.getElementById("editModal").classList.remove("hidden");

        // Fill basic form fields
        document.getElementById("editId").value = training.trainingid || '';
        document.getElementById("editJudul").value = training.trainingtitle || '';
        document.getElementById("editDeskripsi").value = training.trainingdescription || '';
        document.getElementById("editHargaRp").value = training.trainingpricerupiah || '';
        document.getElementById("editHargaDollar").value = training.trainingpricedollar || '';
        document.getElementById("editLokasi").value = training.traininglocation || '';
        document.getElementById("editSlot").value = training.trainingslot || '';

        console.log('Basic fields filled');

        // Set CKEditor data for description with delay to ensure it's ready
        console.log('Setting description:', training.trainingdescription);
        setTimeout(() => {
            setEditCKEditorData(training.trainingdescription);
        }, 100);

        // Format and set schedule
        console.log('Original schedule:', training.trainingschedule);
        const formattedSchedule = formatDateForInput(training.trainingschedule);
        document.getElementById("editJadwal").value = formattedSchedule;
        console.log('Schedule set to:', document.getElementById("editJadwal").value);

        // Set region dropdown with more detailed handling
        const regionSelect = document.getElementById('editRegion');
        console.log('Setting region. Training region ID:', training.trainingregionid);
        console.log('Available options:', Array.from(regionSelect.options).map(opt => ({value: opt.value, text: opt.text})));
        
        if (regionSelect) {
            // First reset all options
            regionSelect.selectedIndex = 0;
            
            // Try to find and select the correct option
            if (training.trainingregionid) {
                const targetValue = String(training.trainingregionid);
                let found = false;
                
                Array.from(regionSelect.options).forEach((option, index) => {
                    if (String(option.value) === targetValue) {
                        regionSelect.selectedIndex = index;
                        found = true;
                        console.log('Region found and selected:', option.text, option.value);
                    }
                });
                
                if (!found) {
                    console.warn('Region not found in dropdown:', targetValue);
                }
            }
        }

        // Handle image preview with better error handling
        const currentImagePreview = document.getElementById("currentImagePreview");
        const previewImage = document.getElementById("previewImage");
        
        console.log('Setting image:', training.trainingimage);
        
        if (training.trainingimage && training.trainingimage.trim() !== '') {
            const imagePath = `/storage/training_images/${training.trainingimage}`;
            console.log('Image path:', imagePath);
            
            previewImage.src = imagePath;
            currentImagePreview.classList.remove("hidden");
            
            previewImage.onload = function() {
                console.log('Image loaded successfully');
            };
            
            previewImage.onerror = function() {
                console.log('Image failed to load, trying alternative path');
                // Try without /storage/ prefix
                previewImage.src = `training_images/${training.trainingimage}`;
                
                previewImage.onerror = function() {
                    console.log('Image failed to load completely, hiding preview');
                    currentImagePreview.classList.add("hidden");
                };
            };
        } else {
            console.log('No image to display');
            currentImagePreview.classList.add("hidden");
            previewImage.src = '';
        }

        // Set form action URL
        const editForm = document.getElementById('editForm');
        editForm.action = `/admin/training/${training.trainingid}`;
        console.log('Form action set to:', editForm.action);
        
        console.log('=== EDIT MODAL SETUP COMPLETE ===');
    }

    function closeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
        
        // Clear CKEditor data
        if (CKEDITOR.instances['editDeskripsi']) {
            CKEDITOR.instances['editDeskripsi'].setData('');
        }
        
        // Reset form
        document.getElementById('editForm').reset();
        
        // Hide image preview
        document.getElementById("currentImagePreview").classList.add("hidden");
    }

    function openAddModal() {
        document.getElementById("addModal").classList.remove("hidden");

        // Reset form
        const addForm = document.getElementById('addForm');
        addForm.reset();

        // Reset CKEditor data for add modal
        if (CKEDITOR.instances['addDeskripsi']) {
            CKEDITOR.instances['addDeskripsi'].setData('');
        }

        // Reset preview image
        const addPreviewImage = document.getElementById('addPreviewImage');
        addPreviewImage.src = '';
        addPreviewImage.classList.add('hidden');
    }

    function closeAddModal() {
        document.getElementById("addModal").classList.add("hidden");
        
        // Reset CKEditor data
        if (CKEDITOR.instances['addDeskripsi']) {
            CKEDITOR.instances['addDeskripsi'].setData('');
        }
        
        // Reset form
        document.getElementById('addForm').reset();
        
        // Hide image preview
        document.getElementById('addPreviewImage').classList.add('hidden');
    }

    // Preview image when file is selected in Edit modal
    document.getElementById('editGambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewImage = document.getElementById('previewImage');
        const currentImagePreview = document.getElementById("currentImagePreview");
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                currentImagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Preview image when file is selected in Add modal
    document.getElementById('addGambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewImage = document.getElementById('addPreviewImage');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
        }
    });

    // Close modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddModal();
        }
    });

    // Handle form submission to sync CKEditor data
    document.getElementById('editForm').addEventListener('submit', function(e) {
        // Sync CKEditor data before submission
        if (CKEDITOR.instances['editDeskripsi']) {
            CKEDITOR.instances['editDeskripsi'].updateElement();
        }
    });

    document.getElementById('addForm').addEventListener('submit', function(e) {
        // Sync CKEditor data before submission
        if (CKEDITOR.instances['addDeskripsi']) {
            CKEDITOR.instances['addDeskripsi'].updateElement();
        }
    });
</script>
</body>
</html>