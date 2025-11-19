<section class="flex flex-col md:flex-row justify-center md:min-h-screen">

    <div class="relative flex w-full">
        <img src="images/hero1.png" alt=""
             class="absolute inset-0 h-full w-full object-cover object-center">

        <div class="relative flex w-full flex-col items-start justify-center bg-black bg-opacity-40 p-6 sm:p-10 lg:p-16">
            <h2 class="text-sm sm:text-base lg:text-lg font-medium text-white text-opacity-75">
                {{ __('banners.welcome.pretitle') }}
            </h2>

            <p class="mt-2 text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-medium text-white max-w-4xl lg:max-w-5xl font-accent leading-tight">
                {{ __('banners.welcome.title') }}
            </p>

            <a href="{{ route('products.index') }}"
               class="mt-6 rounded-md bg-white px-4 py-2.5 text-sm sm:text-base font-medium text-gray-900 hover:bg-gray-50 transition">
                {{ __('banners.welcome.action-label') }}
            </a>
        </div>
    </div>

</section>

