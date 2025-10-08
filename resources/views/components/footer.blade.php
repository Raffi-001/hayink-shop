<footer aria-labelledby="footer-heading" class="bg-gray-50">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="border-t border-gray-100">
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
                                        <a href="/collections/t-shirts" class="text-gray-500 hover:text-gray-600">T-Shirts</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="/collections/scarves" class="text-gray-500 hover:text-gray-600">Scarves</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Customer Service</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="{{ route('contact-us.view') }}" class="text-gray-500 hover:text-gray-600">Contact</a>
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
                                    <li class="text-sm">
                                        <a href="/p/how-it-works" class="text-gray-500 hover:text-gray-600">How it Works</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="https://hayink.com/designer" class="text-gray-500 hover:text-gray-600">Artist Login</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Legal</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="/p/terms-and-conditions" class="text-gray-500 hover:text-gray-600">Terms of Service</a>
                                    </li>
                                    <li class="text-sm">
                                        <a href="/p/cookie-policy" class="text-gray-500 hover:text-gray-600">Cookie Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Icons Section -->
                <div class="mt-12 flex items-center justify-center space-x-6">
                    <a href="https://www.instagram.com/hayink" target="_blank" rel="noopener"
                       class="flex items-center justify-center w-10 h-10 border border-gray-300 rounded-full text-gray-500 hover:text-white hover:bg-pink-500 hover:border-pink-500 transition-colors">
                        <!-- Instagram Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                            <path
                                d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zm0 2A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9a3.5 3.5 0 0 0 3.5-3.5v-9A3.5 3.5 0 0 0 16.5 4h-9zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm5.75-.75a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5z" />
                        </svg>
                    </a>

                    <a href="https://www.linkedin.com/company/hayink" target="_blank" rel="noopener"
                       class="flex items-center justify-center w-10 h-10 border border-gray-300 rounded-full text-gray-500 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition-colors">
                        <!-- LinkedIn Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                            <path
                                d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0V8zm7.5 0h4.8v2.18h.07c.67-1.27 2.32-2.6 4.78-2.6 5.1 0 6.05 3.35 6.05 7.7V24h-5V15.08c0-2.12-.04-4.85-2.95-4.85-2.95 0-3.4 2.3-3.4 4.68V24h-5V8z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Privacy Row -->
            <div class="py-10 md:flex md:items-center md:justify-between border-t border-gray-100 mt-12">
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
    </div>
</footer>
