<div class="relative z-50" x-data="{ menuVisible: false }">
    <!-- User Menu Button -->
    <button class="grid w-16 h-16 transition border-l border-gray-100 lg:border-l-transparent hover:opacity-75"
            x-on:click="menuVisible = !menuVisible">
        <span class="sr-only">User Menu</span>
        <span class="place-self-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </span>
    </button>

    <!-- User Menu Dropdown -->
    <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 shadow-xl rounded-xl"
         x-show="menuVisible"
         x-on:click.away="menuVisible = false"
         x-transition
         x-cloak>

        <div class="space-y-2 p-3">
            <a href="/account" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                My Dashboard
            </a>
            <a href="/" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                Account
            </a>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
