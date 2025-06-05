<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-2">
            <div x-data="{
        selectedImage: '{{ $this->image?->getUrl('large') }}'
    }"
                 class="grid grid-cols-2 gap-4 md:grid-cols-1"
            >
                {{-- Main Image --}}
                <div class="aspect-w-1 aspect-h-1">
                    <img class="object-cover w-full h-full"
                         :src="selectedImage"
                         alt="{{ $this->product->translateAttribute('name') }}" />
                </div>

                {{-- Thumbnails --}}
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    @foreach ($this->images as $image)
                        <div class="aspect-w-1 aspect-h-1"
                             wire:key="image_{{ $image->id }}">
                            <img loading="lazy"
                                 class="object-cover cursor-pointer border border-transparent hover:border-primary-500"
                                 src="{{ $image->getUrl('small') }}"
                                 alt="{{ $this->product->translateAttribute('name') }}"
                                 @click="selectedImage = '{{ $image->getUrl('large') }}'"
                            />
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold">
                        {{ $this->product->translateAttribute('name') }}
                    </h1>

                    <x-product-price class="ml-4 font-medium"
                                     :variant="$this->variant" />
                </div>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $this->variant->sku }}
                </p>

                <article class="mt-4 text-gray-700">
                    {!! $this->product->translateAttribute('description') !!}
                </article>

                <form class="mt-4">
                    <div class="space-y-4">
                        @foreach ($this->productOptions as $option)
                            <fieldset>
                                <legend class="text-xs font-medium text-gray-700">
                                    {{ $option['option']->translate('name') }}
                                </legend>

                                <div class="flex flex-wrap gap-2 mt-2 text-xs tracking-wide uppercase"
                                     x-data="{
                                         selectedOption: @entangle('selectedOptionValues').live,
                                         selectedValues: [],
                                     }"
                                     x-init="selectedValues = Object.values(selectedOption);
                                     $watch('selectedOption', value =>
                                         selectedValues = Object.values(selectedOption)
                                     )">
                                    @foreach ($option['values'] as $value)
                                        <button class="px-6 py-4 font-medium border focus:outline-none  "
                                                type="button"
                                                wire:click="
                                                $set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})
                                            "
                                                :class="{
                                                    ' focus:outline-none  bg-primary-500 border-primary-500 text-white hover:bg-primary-600': selectedValues
                                                        .includes({{ $value->id }}),
                                                    'hover:bg-gray-100': !selectedValues.includes({{ $value->id }})
                                                }">
                                            {{ $value->translate('name') }}
                                        </button>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                    </div>

                    <div class="max-w-xs mt-8">
                        <livewire:components.add-to-cart :purchasable="$this->variant"
                                                         :wire:key="$this->variant->id">
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-12 bg-white border-t pt-8">
            <div class="max-w-screen-xl mx-auto">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">
                    About the Designer
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <img src="/images/designer.png" alt="Designer Name"
                             class="rounded-lg shadow-lg object-cover w-full h-auto" />
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold">Jane Doe</h3>
                        <p class="mt-2 text-gray-700">
                            Jane Doe is an award-winning designer known for her bold aesthetic and thoughtful details.
                            With over a decade of experience in fashion and product design, her work blends tradition
                            with contemporary minimalism.
                        </p>

                        <p class="mt-4 text-gray-700">
                            Her latest collection explores sustainable materials and timeless forms, inspired by nature
                            and urban landscapes. Every piece tells a story — crafted with care, intention, and a strong
                            belief in ethical production.
                        </p>


                        <p class="mt-4 text-sm text-gray-500"><a href="https://instagram.com/janedoe" target="_blank" class="text-blue-500 underline">Browse All Products by This Designer</a></p>
                        <p class="mt-4 text-sm text-gray-500">Follow Jane on Instagram: <a href="https://instagram.com/janedoe" target="_blank" class="text-blue-500 underline">@janedoe</a></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-12">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">
                Other Designs by Jane Doe
            </h2>
            <div class="grid grid-cols-3 gap-4">
            @foreach($this->relatedProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
            </div>
        </div>

    </div>

    <div class="mt-12 bg-gray-100">

        <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">
            Latest Products
        </h2>
        <div class="grid grid-cols-3 gap-4">
            @foreach($this->latestProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        </div>
    </div>
</section>
