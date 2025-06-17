<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>User Data</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: "Poppins", sans-serif; }
        .dashboard-card {
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .dashboard-card:hover {
            box-shadow: 0 8px 32px 0 rgba(156,163,175,0.10), 0 1.5px 4px 0 rgba(0,0,0,0.04);
            transform: translateY(-4px) scale(1.03);
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-gray-900" x-data="userEditModal()">
<div class="flex min-h-screen border border-gray-200">
    @include('components.adminsidebar')
    <main class="flex-1 flex flex-col border-l border-gray-200 md:ml-0 ml-0">
        @include('components.adminnavbar')
        <section class="flex-1 p-6">
            <h2 class="text-2xl font-bold mb-6">User</h2>
            <div class="overflow-x-auto rounded-xl shadow bg-white">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left">Name</th>
                            <th class="py-3 px-4 border-b text-left">Email</th>
                            <th class="py-3 px-4 border-b text-left">Phone</th>
                            <th class="py-3 px-4 border-b text-left">Role</th>
                            <th class="py-3 px-4 border-b text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $user->user_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->user_email }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->user_phone }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                            <td class="py-2 px-4 border-b flex gap-2 justify-center">
                                <button 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded"
                                    @click="openEdit({{ $user->user_id }}, '{{ addslashes($user->user_name) }}', '{{ addslashes($user->user_email) }}', '{{ addslashes($user->user_phone) }}', '{{ $user->role }}')"
                                >
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.user.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Delete user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<!-- Modal Edit User -->
<div 
    class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
    x-show="show"
    x-transition
    style="display: none;"
>
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl" @click="closeEdit()">&times;</button>
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form :action="`/admin/user/${editId}`" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-1 font-semibold">Name</label>
                <input type="text" name="user_name" x-model="editName" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="user_email" x-model="editEmail" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Phone</label>
                <input type="text" name="user_phone" x-model="editPhone" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Role</label>
                <select name="role" x-model="editRole" class="w-full border rounded px-3 py-2" required>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" @click="closeEdit()" class="mr-2 px-4 py-2 rounded border border-gray-300 text-gray-700">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function userEditModal() {
    return {
        show: false,
        editId: null,
        editName: '',
        editEmail: '',
        editPhone: '',
        editRole: '',
        openEdit(id, name, email, phone, role) {
            this.editId = id;
            this.editName = name;
            this.editEmail = email;
            this.editPhone = phone;
            this.editRole = role;
            this.show = true;
        },
        closeEdit() {
            this.show = false;
        }
    }
}
</script>
</body>
</html>