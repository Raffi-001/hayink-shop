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
                        {{ __('global.browse-all') }} <span aria-hidden="true">&rarr;</span>
                    </a>
                @endif
            </div>
        @endif

        {{-- Carousel --}}
        <div class="relative mt-6 sm:mt-8">
            <div class="swiper mySwiper items-bottom">
                <div class="swiper-wrapper mb-12">
                    @foreach ($items as $item)
                        <div class="swiper-slide w-auto p-1">
                            <x-product-card :product="$item" />
                        </div>
                    @endforeach
                </div>


                <!-- Pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>
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
