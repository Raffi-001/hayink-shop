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

                <div class="mx-auto bg-white my-10" x-data="{ open: null }">

                    <!-- Section 1 -->
                    <div class="border-b">
                        <button @click="open === 1 ? open = null : open = 1" class="w-full text-left flex justify-between items-center py-4">
                            <span class="text-lg font-medium">Size Chart</span>
                            <svg :class="{'rotate-180': open === 1}" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="text-gray-700">
                            <div class="bg-white rounded-xl">

                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-left text-sm border border-gray-200">
                                        <thead>
                                        <tr class="bg-gray-100 text-gray-700">
                                            <th class="py-3 px-4 border-b">Size</th>
                                            <th class="py-3 px-4 border-b">Chest (in)</th>
                                            <th class="py-3 px-4 border-b">Length (in)</th>
                                            <th class="py-3 px-4 border-b">Sleeve (in)</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-gray-600">
                                        <tr>
                                            <td class="py-2 px-4 border-b">S</td>
                                            <td class="py-2 px-4 border-b">34–36</td>
                                            <td class="py-2 px-4 border-b">27</td>
                                            <td class="py-2 px-4 border-b">8</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="py-2 px-4 border-b">M</td>
                                            <td class="py-2 px-4 border-b">38–40</td>
                                            <td class="py-2 px-4 border-b">28</td>
                                            <td class="py-2 px-4 border-b">8.5</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4 border-b">L</td>
                                            <td class="py-2 px-4 border-b">42–44</td>
                                            <td class="py-2 px-4 border-b">29</td>
                                            <td class="py-2 px-4 border-b">9</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="py-2 px-4 border-b">XL</td>
                                            <td class="py-2 px-4 border-b">46–48</td>
                                            <td class="py-2 px-4 border-b">30</td>
                                            <td class="py-2 px-4 border-b">9.5</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-4">XXL</td>
                                            <td class="py-2 px-4">50–52</td>
                                            <td class="py-2 px-4">31</td>
                                            <td class="py-2 px-4">10</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <p class="text-xs text-gray-500 mt-4">* Measurements may vary slightly due to manual measurement and fabric properties.</p>
                            </div>

                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="border-b">
                        <button @click="open === 2 ? open = null : open = 2" class="w-full text-left flex justify-between items-center py-4">
                            <span class="text-lg font-medium">Materia &amp; Care</span>
                            <svg :class="{'rotate-180': open === 2}" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="text-gray-700">
                            <div class="max-w-xl mx-auto bg-white">

                                <ul class="space-y-2 text-gray-700 text-sm leading-relaxed list-disc list-inside">
                                    <li><strong>Material:</strong> 100% Organic Cotton</li>
                                    <li><strong>Fabric Weight:</strong> 180 GSM (lightweight and breathable)</li>
                                    <li><strong>Texture:</strong> Soft-touch, pre-shrunk, enzyme-washed</li>
                                </ul>

                                <div class="mt-4">
                                    <h3 class="text-lg font-medium mb-2">Care Instructions</h3>
                                    <ul class="space-y-1 text-gray-700 text-sm list-disc list-inside">
                                        <li>Machine wash cold with like colors</li>
                                        <li>Do not bleach</li>
                                        <li>Tumble dry low or hang dry</li>
                                        <li>Iron on reverse side if needed</li>
                                        <li>Do not dry clean</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="mt-12 bg-white border-t pt-8">
            <div class="max-w-screen-xl mx-auto">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">
                    About the Designer
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <img src="{{ data_get($this, 'designerInfo.image') }}" alt="Designer Name"
                             class="rounded-lg shadow-lg object-cover w-full h-auto" />
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold">{{ $this->product->translateAttribute('designer-name') }}</h3>
                        {!! data_get($this, 'designerInfo.description') !!}


                        <p class="mt-4 text-sm text-gray-500"><a href="{{ data_get($this, 'designerInfo.collectionUrl') }}" target="_blank" class="text-blue-500 underline">Browse All Products by {{ data_get($this, 'designerInfo.name') }}</a></p>
                        <!-- <p class="mt-4 text-sm text-gray-500">Follow Jane on Instagram: <a href="https://instagram.com/janedoe" target="_blank" class="text-blue-500 underline">@janedoe</a></p> -->
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-12">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">
                Other Designs by Jane Doe
            </h2>
            <div class="grid grid-cols-3 gap-4">
            @foreach($this->designersProducts as $product)
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
