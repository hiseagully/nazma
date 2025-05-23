<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-72 md:static md:w-80 border-r flex flex-col p-6 bg-white"
>
    <nav class="flex flex-col space-y-2 text-base font-semibold">
        <!-- Dashboard -->
        <a
            href="/dashboardadmin"
            class="flex items-center gap-3 rounded-md px-4 py-3 transition
                {{ ($activeMenu ?? '') === 'dashboard' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'text-gray-700 hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
        >
            <i class="fas fa-home text-xl" style="color: #FF7A00;"></i>
            <span>Dashboard</span>
        </a>
        <!-- Users -->
        <a
            href="#"
            class="flex items-center gap-3 rounded-md px-4 py-3 transition
                {{ ($activeMenu ?? '') === 'users' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'text-gray-700 hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
        >
            <i class="fas fa-users text-xl" style="color: #FF7A00;"></i>
            <span>Users</span>
        </a>
        <!-- Training Dropdown -->
        <div>
            <button
                type="button"
                onclick="toggleMenu('training-menu')"
                class="flex items-center gap-3 w-full px-4 py-3 rounded-md transition
                    {{ ($activeMenu ?? '') === 'training' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'text-gray-700 hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
            >
                <i class="fas fa-chalkboard-teacher text-xl" style="color: #FF7A00;"></i>
                <span>Training</span>
                <i class="fas fa-chevron-down ml-auto text-sm" style="color: #FF7A00;" id="training-menu-icon"></i>
            </button>
            <nav
                id="training-menu"
                class="ml-8 mt-2 flex flex-col space-y-1 text-base {{ ($activeMenu ?? '') === 'training' ? '' : 'hidden' }}"
            >
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'training' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/trainingadmin">Training</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'trainingtransaction' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/trainingtransactionadmin">Training Transaction</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'trainingticket' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/trainingticketadmin">Training Ticket</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'trainee' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="#">Trainee</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'trainingregion' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/trainingregion">Training Region</a>
            </nav>
        </div>
        <!-- Product Dropdown -->
        <div>
            <button
                type="button"
                onclick="toggleMenu('product-menu')"
                class="flex items-center gap-3 w-full px-4 py-3 rounded-md transition
                    {{ ($activeMenu ?? '') === 'product' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'text-gray-700 hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
            >
                <i class="fas fa-box-open text-xl" style="color: #FF7A00;"></i>
                <span>Product</span>
                <i class="fas fa-chevron-down ml-auto text-sm" style="color: #FF7A00;" id="product-menu-icon"></i>
            </button>
            <nav
                id="product-menu"
                class="ml-8 mt-2 flex flex-col space-y-1 text-base {{ ($activeMenu ?? '') === 'product' ? '' : 'hidden' }}"
            >   
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'products' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/productregionsmapadmin">Product Regions</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'products' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/productcatalog">Product Catalog</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'products' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="#">Products</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'producttransaction' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/producttransaction">Product Transaction</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'customer' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/customerdata">Customer</a>
                <a class="px-4 py-2 rounded-md transition
                    {{ ($activeSubMenu ?? '') === 'productorder' ? 'bg-[#FFF3E6] text-[#FF7A00]' : 'hover:bg-[#FFF3E6] hover:text-[#FF7A00]' }}"
                    href="/productorder">Product Order</a>
            </nav>
        </div>
    </nav>
    <div class="mt-auto pt-6 border-t">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="flex items-center gap-3 text-red-600 hover:text-white hover:bg-red-500 font-semibold text-base w-full px-4 py-3 rounded-md transition"
                type="submit"
            >
                <i class="fas fa-sign-out-alt text-red-400 text-xl"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
<script>
function toggleMenu(menuId) {
    const menu = document.getElementById(menuId);
    menu.classList.toggle('hidden');
    // Optional: rotate chevron
    const icon = document.getElementById(menuId + '-icon');
    if (icon) icon.classList.toggle('rotate-180');
}
</script>
