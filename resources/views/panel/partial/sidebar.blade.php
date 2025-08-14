<div class="min-h-screen w-72 bg-white dark:bg-[#181828] flex flex-col transition-all">
    <div class="flex items-center px-6 py-7">
        <div class="h-10 w-10 rounded-xl bg-[#a58eff] flex items-center justify-center p-1">
           <svg fill="#ffffff" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"></path></g></svg>
        </div>
        <span class="ml-3 font-extrabold text-2xl text-gray-900 dark:text-white">Dashboard</span>
    </div>

    <div class="flex-1 overflow-y-auto">
        <div class="px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1 mt-2">Main Menu</div>
        <nav class="px-2 space-y-2">
                @include('panel.partial.nav')
        </nav>
    </div>

    <div class="flex items-center mb-1 border-t border-gray-100 dark:border-[#232342] mt-auto mx-auto">
        <div class="px-5 py-2 bg-red-700 rounded-xl justify-baseline hover:bg-red-800">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full">
                    <div class="flex items-center rounded-lgfont-semibold text-white dark:hover:bg-red-900/20 transition">
                        <span class="">
                            <!-- Logout SVG -->
                            <svg class="h-6 w-6 transition-colors duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                        </span>
                        <span>Logout</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>
