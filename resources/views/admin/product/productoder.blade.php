<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Product Order</title>
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
            <h2 class="text-xl font-semibold mb-6">Product Order List</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-3 px-4 border-b text-center">No</th>
                        <th class="py-3 px-4 border-b text-left">Order ID</th>
                        <th class="py-3 px-4 border-b text-left">Customer</th>
                        <th class="py-3 px-4 border-b text-left">Product</th>
                        <th class="py-3 px-4 border-b text-center">Qty</th>
                        <th class="py-3 px-4 border-b text-right">Price</th>
                        <th class="py-3 px-4 border-b text-right">Subtotal</th>
                        <th class="py-3 px-4 border-b text-center">Order Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $order->transaction_id }}</td>
                            <td class="py-2 px-4 border-b">
                                {{ $order->transaction->name ?? '-' }}<br>
                                <span class="text-xs text-gray-500">{{ $order->transaction->email ?? '' }}</span>
                            </td>
                            <td class="py-2 px-4 border-b">
                                {{ $order->product_name ?? ($order->product->productname ?? '-') }}
                            </td>
                            <td class="py-2 px-4 border-b text-center">{{ $order->qty }}</td>
                            <td class="py-2 px-4 border-b text-right">{{ number_format($order->price, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border-b text-right">{{ number_format($order->subtotal, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $order->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-2 px-4 text-center text-gray-500">Not orders found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>