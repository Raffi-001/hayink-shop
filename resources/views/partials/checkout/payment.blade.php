<div class="bg-white border border-gray-100 rounded-xl">
    <div class="flex items-center h-16 px-6 border-b border-gray-100">
        <h3 class="text-lg font-medium">
            Payment
        </h3>
    </div>

    @if ($currentStep >= $step)
        <div class="p-6 space-y-4">
            <div class="flex justify-center">
                @php
                    $route = route('ameria-pay');
                @endphp

                <button
                    class="px-8 py-4 text-lg border font-medium rounded-lg flex gap-3 items-center bg-black text-white hover:bg-gray-800 transition-colors"
                    type="button"
                    x-data
                    @click="window.location.href = '{{ $route }}'"
                >
                    <img src="/images/ambank.png" class="w-10 h-auto"/>
                    <span>Pay with Ameria Bank</span>
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Secure payment processing by Ameria Bank
                </p>
            </div>
        </div>
    @endif
</div>