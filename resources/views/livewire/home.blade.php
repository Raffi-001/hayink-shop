<div>
    <x-welcome-banner />

    <div class="pt-16">
        @if (data_get($this, 'frontPageCollections'))
            @foreach($this->frontPageCollections as $collection)
                <section class="bg-white">
                    <div class="px-4 sm:px-6 lg:px-8 pb-16">
                        <div class="sm:flex sm:items-baseline sm:justify-between">
                            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight text-gray-900">
                                {{ $collection->translateAttribute('name') }}
                            </h2>
                            <a href="/collections/{{ $collection->defaultUrl->slug }}"
                               class="hidden text-xs sm:text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                                Browse all <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>

                        <div x-data="carousel({ total: {{ $collection->products->count() }}, perView: 5 })" class="relative mt-6 sm:mt-8">
                            <div class="overflow-hidden">
                                <div class="flex transition-transform duration-300"
                                     :style="'transform: translateX(-' + (currentIndex * (100 / perView)) + '%)'">
                                    @foreach ($collection->products as $product)
                                        <div class="flex-shrink-0 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 p-1">
                                            <x-product-card :product="$product" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Prev/Next Buttons -->
                            <button @click="prev"
                                    class="absolute top-1/2 left-0 -translate-y-1/2 bg-white rounded-full shadow p-2 hover:bg-gray-100">
                                &#10094;
                            </button>
                            <button @click="next"
                                    class="absolute top-1/2 right-0 -translate-y-1/2 bg-white rounded-full shadow p-2 hover:bg-gray-100">
                                &#10095;
                            </button>
                        </div>

                        <div class="mt-4 sm:hidden">
                            <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                                Browse all <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif
    </div>

    <!-- CTA Grid -->
    <div class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ([
                ['img' => '/images/front-sections-1.png', 'title' => 'Limited Edition Drops', 'text' => 'One-of-a-kind fashion pieces from silk scarves and linen shirts to bold kimonos...', 'link' => '/collections/t-shirts', 'btn' => 'View Collection'],
                ['img' => '/images/front-sections-2.png', 'title' => 'Premium Merch for Your Business', 'text' => 'Custom apparel your team will actually want to wear. High-quality prints, premium fabrics, and tailored designs for companies, studios, and organizations in Armenia.', 'link' => '/services', 'btn' => 'More About Our Services'],
                ['img' => '/images/front-sections-3.png', 'title' => 'Make Your Own Design', 'text' => 'Your idea, your print. Upload your design and we’ll craft it on premium t-shirts, hoodies, and more — made locally, just for you.', 'link' => '/create-your-own', 'btn' => 'Custom Products'],
                ['img' => '/images/front-sections-4.png', 'title' => 'Become a Creator with Us', 'text' => 'Turn your art into wearable merch. We partner with Armenian artists and creators, bringing their designs to life on premium apparel and helping them sell globally.', 'link' => '/apply-as-an-artist', 'btn' => 'Apply as an Artist'],
            ] as $cta)
                <div class="relative aspect-square overflow-hidden rounded-lg">
                    <img src="{{ $cta['img'] }}" alt="{{ $cta['title'] }}" class="absolute inset-0 w-full h-full object-cover" loading="lazy" decoding="async" />
                    <div class="absolute inset-0 bg-black/50"></div>
                    <div class="absolute bottom-0 left-0 z-10 text-white w-full p-4 sm:p-6 lg:p-8">
                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                            <div class="flex flex-col">
                                <h2 class="text-lg sm:text-2xl lg:text-3xl font-accent leading-snug">{{ $cta['title'] }}</h2>
                                <p class="text-sm sm:text-base lg:text-lg mt-1 max-w-md">{{ $cta['text'] }}</p>
                            </div>
                            <a href="{{ $cta['link'] }}"
                               class="px-4 py-2 text-xs sm:text-sm lg:text-base font-medium text-center text-white border border-white/70 hover:border-white hover:bg-white/10 rounded-md transition-all whitespace-nowrap self-start sm:self-auto">
                                {{ $cta['btn'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Artists Section -->
    <div class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="sm:flex sm:items-baseline sm:justify-between">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight text-gray-900">
                Artists
            </h2>
            <a href="/artists" class="hidden text-xs sm:text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                Browse all <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <section class="pt-8 flex flex-wrap justify-center gap-6 sm:gap-8 bg-white max-w-7xl mx-auto px-4">
            @foreach ($this->artists as $collection)
                <div class="w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 flex justify-center">
                    <a href="/collections/{{ $collection->translateAttribute('name') }}" class="w-full">
                        <div class="flex flex-col items-center gap-4 border border-primary-200 p-4 sm:p-6 rounded-lg hover:shadow-md transition">
                            <img src="/storage/{{ $collection->translateAttribute('profile-photo') }}"
                                 class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-full"
                                 alt="{{ $collection->translateAttribute('name') }}" />
                            <div class="flex flex-col items-center text-center gap-1">
                                <div class="font-bold text-sm sm:text-base lg:text-lg">
                                    {{ $collection->translateAttribute('name') }}
                                </div>
                                <div class="text-xs sm:text-sm text-slate-500">
                                    {{ $collection->products->count() }} Designs
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>
    </div>
</div>
