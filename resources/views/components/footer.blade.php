<footer aria-labelledby="footer-heading" class="bg-gray-50 mt-8">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="border-t border-gray-200">
            <div class="pb-20 pt-16">
                <div class="md:flex md:justify-center">
                    <x-brand.logo class="w-auto h-8 text-indigo-600" />
                </div>
                <div class="mx-auto mt-16 max-w-5xl xl:grid xl:grid-cols-2 xl:gap-8">
                    <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                        <div class="space-y-12 md:grid md:grid-cols-2 md:gap-8 md:space-y-0">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Products</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="/collections/men" class="text-gray-500 hover:text-gray-600">Men</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="/collections/women" class="text-gray-500 hover:text-gray-600">Women</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Customer Service</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600">Contact</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600">Shipping</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600">Returns</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="space-y-12 md:grid md:grid-cols-2 md:gap-8 md:space-y-0">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Company</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="/about" class="text-gray-500 hover:text-gray-600">About Us</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Legal</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600">Terms of Service</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 lg:gap-x-6 xl:gap-x-8" style="display: none">
                <div class="flex items-center rounded-lg bg-gray-100 p-6 sm:p-10">
                    <div class="mx-auto max-w-sm">
                        <h3 class="font-semibold text-gray-900">Sign up for our newsletter</h3>
                        <p class="mt-2 text-sm text-gray-500">The latest news, articles, and resources, sent to your inbox weekly.</p>
                        <form class="mt-4 sm:mt-6 sm:flex">
                            <label for="email-address" class="sr-only">Email address</label>
                            <input
                                id="email-address"
                                type="text"
                                autocomplete="email"
                                required
                                class="w-full min-w-0 appearance-none rounded-md border border-gray-300 bg-white px-4 py-2 text-base text-gray-900 placeholder-gray-500 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                            />
                            <div class="mt-3 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                                <button
                                    type="submit"
                                    class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-white"
                                >
                                    Sign up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="relative mt-6 flex items-center px-6 py-12 sm:px-10 sm:py-16 lg:mt-0">
                    <div class="absolute inset-0 overflow-hidden rounded-lg">

                        <img src="https://tailwindui.com/img/ecommerce-images/footer-02-exclusive-sale.jpg" alt="" class="h-full w-full object-cover object-center saturate-0 filter" />
                        <div class="absolute inset-0 bg-indigo-600 bg-opacity-90"></div>
                    </div>
                    <div class="relative mx-auto max-w-sm text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-white">Get early access</h3>
                        <p class="mt-2 text-gray-200">
                            Did you sign up to the newsletter? If so, use the keyword we sent you to get access.
                            <a href="#" class="whitespace-nowrap font-bold text-white hover:text-gray-200">Go now<span aria-hidden="true"> &rarr;</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-10 md:flex md:items-center md:justify-between">
            <div class="text-center md:text-left">
                <p class="text-sm text-gray-500">
                    &copy; {{ now()->year }} HayInk. All Rights Reserved.
                </p>
            </div>

            <div class="mt-4 flex items-center justify-center md:mt-0">
                <div class="flex space-x-8">
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-600">Privacy</a>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-600">Terms</a>
                </div>
            </div>
        </div>
    </div>
</footer>
