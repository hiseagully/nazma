<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-72 md:static md:w-80 border-r flex flex-col p-6 bg-white"
    style="border-color: #FF7A00;">
    <nav class="flex flex-col space-y-5 text-base font-semibold">
        <a
            class="flex items-center space-x-3 rounded-md px-4 py-3"
            style="color: #FF7A00; background: #FFF3E6;"
            href="#">
            <i class="fas fa-home text-xl" style="color: #FF7A00;"></i>
            <span>Dashboard</span>
        </a>
        <a
            class="flex items-center space-x-3 text-gray-600 hover:text-white hover:bg-[#FF7A00] px-4 py-3 rounded-md transition"
            href="#"
        >
            <i class="fas fa-users text-xl" style="color: #FF7A00;"></i>
            <span>Users</span>
        </a>
        <div>
            <button
                aria-expanded="false"
                aria-controls="training-menu"
                class="flex items-center space-x-3 text-gray-600 hover:text-white hover:bg-[#FF7A00] font-semibold w-full px-4 py-3 rounded-md focus:outline-none transition"
                type="button"
                onclick="toggleMenu('training-menu')"
            >
                <i class="fas fa-chalkboard-teacher text-xl" style="color: #FF7A00;"></i>
                <span>Training</span>
                <i
                    class="fas fa-chevron-down ml-auto text-sm transition-transform duration-200"
                    style="color: #FF7A00;"
                    id="training-menu-icon"
                ></i>
            </button>
            <nav
                class="ml-10 mt-2 flex flex-col space-y-2 text-gray-600 text-base hidden"
                id="training-menu"
            >
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Training
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Training Transaction
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Training Ticket
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Trainee
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="/trainingregion"
                >
                    Training Region
                </a>
            </nav>
        </div>
        <div>
            <button
                aria-expanded="false"
                aria-controls="product-menu"
                class="flex items-center space-x-3 text-gray-600 hover:text-white hover:bg-[#FF7A00] font-semibold w-full px-4 py-3 rounded-md focus:outline-none transition"
                type="button"
                onclick="toggleMenu('product-menu')"
            >
                <i class="fas fa-box-open text-xl" style="color: #FF7A00;"></i>
                <span>Product</span>
                <i
                    class="fas fa-chevron-down ml-auto text-sm transition-transform duration-200"
                    style="color: #FF7A00;"
                    id="product-menu-icon"
                ></i>
            </button>
            <nav
                class="ml-10 mt-2 flex flex-col space-y-2 text-gray-600 text-base hidden"
                id="product-menu"
            >
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Products
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Product Transaction
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Customer
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-[#FFF3E6] hover:text-[#FF7A00]"
                    href="#"
                >
                    Product Order
                </a>
            </nav>
        </div>
    </nav>
    <div class="mt-auto pt-6 border-t" style="border-color: #FF7A00;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="flex items-center space-x-3 text-red-600 hover:text-white hover:bg-red-500 font-semibold text-base w-full px-4 py-3 rounded-md transition"
                type="submit"
            >
                <i class="fas fa-sign-out-alt text-red-400 text-xl"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
