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
                <h2 class="text-xl font-semibold">Training Ticket Management</h2>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-4 border-b text-left">No</th>
                            <th class="py-3 px-4 border-b text-left">Training Title</th>
                            <th class="py-3 px-4 border-b text-left">Day</th>
                            <th class="py-3 px-4 border-b text-left">Status</th>
                            <th class="py-3 px-4 border-b text-left">Trainee</th>
                            <th class="py-3 px-4 border-b text-left">Transaction Date</th>
                            <th class="py-3 px-4 border-b text-left">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $trx->training->trainingtitle ?? '-' }}</td>
                            <td class="py-2 px-4 border-b">{{ $trx->trainingtransactiondate }}</td> 
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('admin.trainingticket.updatestatus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $trx->id }}">
                                    @php
                                        $defaultStatus = 'Payment Success';
                                        $selectedStatus = session("ticket_status_{$trx->id}", $defaultStatus);
                                    @endphp
                                    <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                        <option value="Ongoing" {{ $selectedStatus == 'Ongoing' ? 'selected' : '' }}>Upcoming</option>
                                        <option value="Completed" {{ $selectedStatus == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $trx->transactiontraineename }}</td>
                            <td class="py-2 px-4 border-b">
                                {{ $trx->created_at ? $trx->created_at->format('Y-m-d') : '-' }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                <div>
                                    <div>{{ $trx->transactiontraineename }}</div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="py-2 px-4 text-gray-500 text-center">No ticket found.</td>
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