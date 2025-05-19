<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-72 md:static md:w-80 border-r border-gray-200 flex flex-col p-6 bg-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out"
>
    <div class="mb-10">
        <img
            alt="Company logo with blue wave icon"
            class="w-12 h-12"
            height="48"
            src="https://storage.googleapis.com/a1aa/image/6c4c8205-51d8-4f5d-380d-392eb2e4959c.jpg"
            width="48"
        />
    </div>
    <nav class="flex flex-col space-y-5 text-base font-semibold">
        <a
            class="flex items-center space-x-3 text-indigo-600 bg-indigo-50 rounded-md px-4 py-3"
            href="#">
            <i class="fas fa-home text-indigo-600 text-xl"></i>
            <span>Dashboard</span>
        </a>
        <a
            class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 px-4 py-3"
            href="#"
        >
            <i class="fas fa-users text-gray-400 text-xl"></i>
            <span>Users</span>
        </a>
        <div>
            <button
                aria-expanded="false"
                aria-controls="training-menu"
                class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 font-semibold w-full px-4 py-3 rounded-md focus:outline-none"
                type="button"
                onclick="toggleMenu('training-menu')"
            >
                <i class="fas fa-chalkboard-teacher text-gray-400 text-xl"></i>
                <span>Training</span>
                <i
                    class="fas fa-chevron-down ml-auto text-gray-400 text-sm transition-transform duration-200"
                    id="training-menu-icon"
                ></i>
            </button>
            <nav
                class="ml-10 mt-2 flex flex-col space-y-2 text-gray-600 text-base hidden"
                id="training-menu"
            >
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Training
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Training Transaction
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Training Ticket
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Trainee
                </a>
            </nav>
        </div>
        <div>
            <button
                aria-expanded="false"
                aria-controls="product-menu"
                class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 font-semibold w-full px-4 py-3 rounded-md focus:outline-none"
                type="button"
                onclick="toggleMenu('product-menu')"
            >
                <i class="fas fa-box-open text-gray-400 text-xl"></i>
                <span>Product</span>
                <i
                    class="fas fa-chevron-down ml-auto text-gray-400 text-sm transition-transform duration-200"
                    id="product-menu-icon"
                ></i>
            </button>
            <nav
                class="ml-10 mt-2 flex flex-col space-y-2 text-gray-600 text-base hidden"
                id="product-menu"
            >
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Products
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Product Transaction
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Customer
                </a>
                <a
                    class="px-4 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600"
                    href="#"
                >
                    Product Order
                </a>
            </nav>
        </div>
    </nav>
    <div class="mt-auto pt-6 border-t border-gray-200">
        <button
            class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 font-semibold text-base w-full px-4 py-3 rounded-md"
            type="button"
        >
            <i class="fas fa-cog text-gray-400 text-xl"></i>
            <span>Settings</span>
        </button>
    </div>
</aside>
