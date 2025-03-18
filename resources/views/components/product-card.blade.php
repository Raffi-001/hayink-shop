@props(['product'])

<div class="group relative ">


    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden relative">
        <!-- <img src="images/men-1.jpg" alt="Model wearing" class="h-full w-full object-cover object-center group-hover:opacity-75" /> -->
        <a class="relative" href="{{ route('product.view', $product->defaultUrl->slug) }}" wire:navigate>
            <div class="overflow-hidden aspect-w-1 aspect-h-1">
                @if ($product->thumbnail)
                    <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                        src="{{ $product->thumbnail->getUrl('medium') }}"
                        alt="{{ $product->translateAttribute('name') }}" />
                @endif


            </div>
        </a>

        <div  class="relative z-50">
            <button  class="border-0 focus:outline-none absolute left-0 bottom-0  text-white bg-secondary-500 uppercase justify-center font-medium w-full hidden group-hover:flex text-md py-2.5">
                Quick Add
            </button>

        </div>

    </div>
    <a class="relative" href="{{ route('product.view', $product->defaultUrl->slug) }}" wire:navigate>
        <h3 class="mt-4 text-base font-semibold text-gray-900">
            {{ $product->translateAttribute('name') }}
        </h3>
        <p class="mt-1 text-sm text-gray-600">
            <span class="sr-only">
                Price
            </span>

            <x-product-price :product="$product" />
        </p>
    </a>


</div>
