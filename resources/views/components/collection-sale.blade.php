<!-- Sale and testimonials -->
<div class="relative overflow-hidden">
    <!-- Decorative background image and gradient -->
    <div aria-hidden="true" class="absolute inset-0">
        <div class="absolute inset-0">
            <img src="images/bg.jpg" alt="" class="h-full w-full object-cover object-center" />
        </div>
        <div class="absolute inset-0 bg-white bg-opacity-75"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white via-white"></div>
    </div>

    <!-- Sale -->
    <section aria-labelledby="sale-heading" class="relative mx-auto flex max-w-7xl flex-col items-center px-4 pt-32 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">Get 25% off during our one-time sale</h2>
            <p class="mx-auto mt-4 max-w-xl text-xl text-gray-600">Most of our products are limited releases that won't come back. Get your favorite items while they're in stock.</p>
            <a href="#" class="mt-6 inline-block w-full rounded-md border border-transparent bg-gray-900 px-8 py-3 font-medium text-white hover:bg-gray-800 sm:w-auto">Get access to our one-time sale</a>
        </div>
    </section>

        
</div>

<section>
    <div class="p-8 overflow-hidden border-4 border-gray-900 rounded-lg">
        <div class="sm:py-32 sm:relative">
            <div>
                <h2 class="text-3xl font-extrabold sm:text-5xl">
                    {{ $this->saleCollection->translateAttribute('name') }}
                </h2>

                @if ($this->saleCollection->translateAttribute('description'))
                    <p class="mt-1 text-lg font-medium">
                        {!! $this->saleCollection->translateAttribute('description') !!}
                    </p>
                @endif

                <a href="{{ route('collection.view', $this->saleCollection->defaultUrl->slug) }}"
                   class="inline-block px-5 py-3 mt-6 text-sm font-medium text-white bg-black rounded-lg hover:ring-1 hover:ring-black"
                   wire:navigate
                >
                    Shop the Sale
                </a>
            </div>

            <div class="mt-8 sm:absolute sm:right-0 sm:top-0 sm:mt-0">
                <div class="flex flex-col">
                    @foreach ($this->saleCollectionImages as $imageGroup)
                        <div class="gap-8 first:flex last:sm:flex last:hidden">
                            @foreach ($imageGroup as $image)
                                <img class="object-cover w-48 h-48 rounded-lg lg:h-72 lg:w-72 odd:mt-8"
                                     src="{{ $image->getUrl('medium') }}"
                                     loading="lazy" />
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
