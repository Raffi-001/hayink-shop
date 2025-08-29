<!-- <section class="bg-gray-50">
    <div class="w-full px-4 py-2 mx-auto sm:px-6 lg:px-8 overflow-hidden">

        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Welcome to

                <span class="text-indigo-600">
                    HayInk
                </span>

            </h1>
        </div>

    </div>
</section> -->


<section class="flex flex-col md:flex-row justify-center md:min-h-screen ">

    <div class="relative flex w-full">
        <img src="images/welcome-img-1.png" alt="" class="absolute inset-0 h-full w-full object-cover object-center">
        <div class="relative flex w-full flex-col items-start justify-center bg-black bg-opacity-40 p-8 sm:p-12">
            <h2 class="text-lg font-medium text-white text-opacity-75">Cozy Up</h2>
            <p class="mt-1 text-5xl font-medium text-white max-w-5xl font-accent">Stay stylish with our range of t-shirts</p>
            <a href="{{ route('products.index') }}" class="mt-4 rounded-md bg-white px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50">Shop now</a>
        </div>
    </div>
</section>
