<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Customer Data Admin</title>
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
    <x-adminsidebar :activeMenu="'product'" :activeSubMenu="'customer'" />
    <!-- Main content -->
    <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
        <!-- Top bar -->
        @include('components.adminnavbar')
        <!-- Content area -->
        <section class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Customer Data Management</h2>
            </div>
            <div class="flex justify-start items-start">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-4 border-b text-left">No</th>
                            <th class="py-3 px-4 border-b text-left">Nama</th>
                            <th class="py-3 px-4 border-b text-left">Email</th>
                            <th class="py-3 px-4 border-b text-left">No HP</th>
                            <th class="py-3 px-4 border-b text-left">Negara</th>
                            <th class="py-3 px-4 border-b text-left">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b">{{ $customer->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $customer->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $customer->phone }}</td>
                                <td class="py-2 px-4 border-b">{{ $customer->country ?? '-' }}</td>
                                <td class="py-2 px-4 border-b">
                                    {{ $customer->address }}
                                    @if($customer->city)
                                        <br><span class="text-xs text-gray-500">{{ $customer->city }}</span>
                                    @endif
                                    @if($customer->postal_code)
                                        <br><span class="text-xs text-gray-500">({{ $customer->postal_code }})</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">No customer found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const backdrop = document.getElementById("sidebar-backdrop");
        sidebar.classList.toggle("-translate-x-full");
        backdrop.classList.toggle("hidden");
    }
</script>
<x-footer></x-footer>
</body>
</html>