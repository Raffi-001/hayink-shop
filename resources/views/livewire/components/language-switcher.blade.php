<div x-data="{ open: false }" class="relative">
    <!-- Button -->
    <button
        @click="open = !open"
        class="lg:flex items-center gap-2 px-4 w-md py-1 text-sm font-medium text-center text-white bg-primary-500 hover:bg-primary-600 mr-4 hidden"
    >
        <span class="text-xl">
            {{ $languages[$current]['flag'] }}
        </span>
        <span>{{ $languages[$current]['label'] }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Dropdown -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute mt-2 w-40 bg-white border rounded-md shadow-lg z-50"
    >
        @foreach($languages as $key => $lang)
            <button
                wire:click="switch('{{ $key }}')"
                class="flex items-center gap-2 w-full px-3 py-2 text-left hover:bg-gray-100"
            >
                <span class="text-xl">{{ $lang['flag'] }}</span>
                <span>{{ $lang['label'] }}</span>
            </button>
        @endforeach
    </div>
</div>
