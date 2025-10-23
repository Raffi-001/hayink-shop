<div>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        {{-- Display session messages --}}
        @if (session('error'))
            <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-start">
            <div class="px-6 py-8 space-y-4 bg-white border border-gray-100 lg:sticky lg:top-8 rounded-xl lg:order-last">
                <h3 class="font-medium">
                    Order Summary
                </h3>

                <div class="flow-root">
                    <div class="-my-4 divide-y divide-gray-100">
                        @foreach ($cart->lines as $line)
                            <div class="flex items-center py-4"
                                 wire:key="cart_line_{{ $line->id }}">
                                <img class="object-cover w-16 h-16 rounded"
                                     src="{{ $line->purchasable->getThumbnail()->getUrl() }}" />

                                <div class="flex-1 ml-4">
                                    <p class="text-sm font-medium max-w-[35ch]">
                                        {{ $line->purchasable->getDescription() }}
                                    </p>

                                    <span class="block mt-1 text-xs text-gray-500">
                                        {{ $line->quantity }} @ {{ $line->subTotal->formatted() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flow-root">
                    <dl class="-my-4 text-sm divide-y divide-gray-100">
                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                Sub Total
                            </dt>

                            <dd class="w-1/2 text-right">
                                {{ $cart->subTotal->formatted() }}
                            </dd>
                        </div>

                        @if ($this->shippingOption)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $this->shippingOption->getDescription() }}
                                </dt>

                                <dd class="w-1/2 text-right">
                                    {{ $this->shippingOption->getPrice()->formatted() }}
                                </dd>
                            </div>
                        @endif

                        @foreach ($cart->taxBreakdown->amounts as $tax)
                            <div class="flex flex-wrap py-4">
                                <dt class="w-1/2 font-medium">
                                    {{ $tax->description }}
                                </dt>

                                <dd class="w-1/2 text-right">
                                    {{ $tax->price->formatted() }}
                                </dd>
                            </div>
                        @endforeach

                        <div class="flex flex-wrap py-4">
                            <dt class="w-1/2 font-medium">
                                Total
                            </dt>

                            <dd class="w-1/2 text-right">
                                {{ $cart->total->formatted() }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                @include('partials.checkout.address', [
                    'type' => 'shipping',
                    'step' => $steps['shipping_address'],
                ])

                @include('partials.checkout.shipping_option', [
                    'step' => $steps['shipping_option'],
                ])

                @include('partials.checkout.address', [
                    'type' => 'billing',
                    'step' => $steps['billing_address'],
                ])

                @include('partials.checkout.payment', [
                    'step' => $steps['payment'],
                ])
            </div>
        </div>
    </div>
</div>
