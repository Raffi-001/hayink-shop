<section class="bg-white">
    <div class="px-4 sm:px-6 lg:px-8 pb-16 relative">
        {{-- Title + Browse --}}
        @if ($title)
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight text-gray-900">
                    {{ $title }}
                </h2>
                @if ($browseLink)
                    <a href="{{ $browseLink }}"
                       class="hidden text-xs sm:text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                        Browse all <span aria-hidden="true">&rarr;</span>
                    </a>
                @endif
            </div>
        @endif

        {{-- Carousel --}}
        <div class="relative mt-6 sm:mt-8">
            <div class="embla overflow-hidden" x-data>
                <div class="embla__container flex">
                    @foreach ($items as $item)
                        <div class="embla__slide flex-shrink-0 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 p-2">
                            <x-product-card :product="$item" />
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Arrows --}}
            <button
                class="embla__prev absolute top-1/2 left-0 -translate-y-1/2 bg-white border border-gray-200 rounded-full shadow p-2 hover:bg-gray-50 z-10"
                aria-label="Previous slide">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                               d="M15 19l-7-7 7-7"/></svg>
            </button>

            <button
                class="embla__next absolute top-1/2 right-0 -translate-y-1/2 bg-white border border-gray-200 rounded-full shadow p-2 hover:bg-gray-50 z-10"
                aria-label="Next slide">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                               d="M9 5l7 7-7 7"/></svg>
            </button>

            {{-- Pagination --}}
            <div class="embla__dots flex justify-center gap-2 mt-6"></div>
        </div>

        {{-- Mobile browse link --}}
        @if ($browseLink)
            <div class="mt-4 sm:hidden">
                <a href="{{ $browseLink }}" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                    Browse all <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        @endif
    </div>
</section>
