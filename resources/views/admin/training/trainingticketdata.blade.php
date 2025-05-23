<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Training Ticket Admin</title>
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
    <x-adminsidebar :activeMenu="'training'" :activeSubMenu="'trainingticket'" />
    
    <!-- Main content -->
    <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
        <!-- Top bar -->
        @include('components.adminnavbar')

        <!-- Content area -->
        <section class="flex-1 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-orange-500">Training Ticket Management</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-orange-100 text-orange-700">
                            <th class="py-3 px-4 border-b text-center">No</th>
                            <th class="py-3 px-4 border-b text-left">User</th>
                            <th class="py-3 px-4 border-b text-left">Training Title</th>
                            <th class="py-3 px-4 border-b text-center">Status</th>
                            <th class="py-3 px-4 border-b text-center">Date</th>
                            <th class="py-3 px-4 border-b text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $ticket->user->user_name ?? '-' }}</td>
                            <td class="py-2 px-4 border-b">{{ $ticket->training->trainingtitle ?? '-' }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $ticket->trainingtransactionstatus ?? '-' }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                {{ \Carbon\Carbon::parse($ticket->trainingtransactiondate)->format('d M Y') }}
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/trainingticketdetail?id={{ $ticket->trainingtransactionid }}"
                                   class="text-blue-600 hover:underline">
                                    See more
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-2 px-4 text-center text-gray-500">No tickets found.</td>
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