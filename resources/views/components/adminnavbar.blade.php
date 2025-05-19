<nav class="flex items-center justify-between px-4 sm:px-6 py-5 border-b border-gray-200">
 <div class="flex items-center space-x-4 w-full">
  <button
   id="sidebar-toggle"
   aria-label="Toggle sidebar"
   class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-2 flex-shrink-0"
   type="button"
   onclick="toggleSidebar()"
  >
   <i class="fas fa-bars text-2xl"></i>
  </button>
  <form class="flex items-center flex-grow max-w-full">
   <label class="sr-only" for="search">Search</label>
   <div class="relative w-full">
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
     <i class="fas fa-search text-lg"></i>
    </div>
    <input
     class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-md text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
     id="search"
     placeholder="Search"
     type="search"
    />
   </div>
  </form>
 </div>
 <div class="flex items-center space-x-8 ml-8">
  <button
   aria-label="Notifications"
   class="text-gray-400 hover:text-gray-600 focus:outline-none"
   type="button"
  >
   <i class="far fa-bell text-2xl"></i>
  </button>
  <div class="border-l border-gray-200 h-7"></div>
  <button
   aria-expanded="false"
   aria-haspopup="true"
   class="flex items-center space-x-3 focus:outline-none"
   type="button"
  >
   <img
    alt="Profile picture of Tom Cook, a bald man with glasses"
    class="w-10 h-10 rounded-full"
    height="40"
    src="https://storage.googleapis.com/a1aa/image/3a25fdab-0611-4705-1b64-440e5835859d.jpg"
    width="40"
   />
   <span class="font-semibold text-gray-900 text-base">Hiseagully</span>
   <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
  </button>
 </div>
</nav>
