@extends('layouts.static')

@section('content')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
<div>
    <!-- component -->
    <!--
        Author: Surjith S M
        Twitter: @surjithctly

        Get more templates on web3templates.com
        Tailwind Play: https://play.tailwindcss.com/O0fbQqzI8M
    -->

    <section class="py-24 flex items-center justify-center bg-primary-100" style="background: linear-gradient(
          rgba(0, 0, 0, 0.7),
          rgba(0, 0, 0, 0.7)
        ), url('/images/services-header.png'); background-size: contain;">
        <div class="mx-auto max-w-[58rem]">
            <div class="text-center">
                <p class="text-lg font-medium leading-8 text-slate-200">About HayInk</p>
                <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-white">Celebrating Armenian Creativity, One Print at a Time</h1>
                <p class="mt-3 text-lg leading-relaxed text-slate-200">we celebrate creativity and empower Armenian artists by bringing their art to life</p>
            </div>

            <div class="mt-6 flex items-center justify-center gap-4">
                <a href="#" class="transform rounded-md bg-primary-500 px-5 py-3 font-medium text-white transition-colors hover:bg-primary-600">Meet the Artists</a>
            </div>
        </div>
    </section>

    <section class="py-8 lg:py-24 flex flex-col items-center gap-8 bg-white">
        <div class="max-w-7xl md:grid md:grid-cols-3 gap-8 px-8">
            <div class="">
                <img src="/images/services-1.png" />
            </div>
            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[1.5rem] lg:text-[2rem] font-bold tracking-tight text-black">01.Durable Prints Premium Fabrics</h1>
                    <p class="mt-3 text-xl lg:text-2xl leading-relaxed text-slate-400">We understand time matters — that’s why we offer quick turnaround times, even for custom and bulk orders. From first sketch to delivery, we move fast without compromising on quality. Perfect for events, campaigns, and seasonal drops.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl md:grid md:grid-cols-3 gap-8 px-8">
            <div class="">
                <img src="/images/services-2.png" />
            </div>
            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[1.5rem] lg:text-[2rem] font-bold tracking-tight text-black">02. Fast turnaround, no hassle.</h1>
                    <p class="mt-3 text-xl lg:text-2xl leading-relaxed text-slate-400">We understand time matters — that’s why we offer quick turnaround times, even for custom and bulk orders. From first sketch to delivery, we move fast without compromising on quality. Perfect for events, campaigns, and seasonal drops.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl md:grid md:grid-cols-3 gap-8 px-8">
            <div class="">
                <img src="/images/services-3.png" />
            </div>
            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[1.5rem] lg:text-[2rem] font-bold tracking-tight text-black">03. Small Runs to Big Drops</h1>
                    <p class="mt-3 text-xl lg:text-2xl leading-relaxed text-slate-400">

                        Whether you need 10 custom pieces or 500+, we’ve got you. No minimums, scalable printing options, and flexible delivery make Hay Ink the right partner for both grassroots campaigns and growing brands.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl md:grid md:grid-cols-3 gap-8 px-8">
            <div class="">
                <img src="/images/services-4.png" />
            </div>
            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[1.5rem] lg:text-[2rem] font-bold tracking-tight text-black">04. Local Expertise, Personal Support</h1>
                    <p class="mt-3 text-xl lg:text-2xl leading-relaxed text-slate-400">From the first idea to final delivery, you’ll work directly with a team based in Armenia that understands your market. Whether you’re a museum, NGO, or local brand, we guide you every step of the way.</p>
                </div>
            </div>
        </div>

    </section>

    <section class="py-8 lg:py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto px-8">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Discover our range</h1>



        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full">
            <div class="max-w-7xl md:grid md:grid-cols-3 gap-8">
                <div class="col-span-2">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">01. Garments</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">T-Shirts, Hoodies, and Sweatshirts  We print on high-quality T-shirts, hoodies, and sweatshirts in many styles and sizes. Our garments are soft, strong, and perfect for events, teams, or branded clothing. You can order in small or large quantities.</p>
                    </div>
                </div>
                <div class="">
                    <img src="/images/services-2-1.png" />
                </div>
            </div>
            <div class="max-w-7xl md:grid md:grid-cols-3 gap-8">
                <div class="col-span-2">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">02. Silk & accessories</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">We print on elegant fabrics like silk and satin, and also offer custom caps and hats. Perfect for fashion brands, gift shops, or cultural events. Soft, detailed prints made in Armenia.</p>
                    </div>
                </div>
                <div class="">
                    <img src="/images/services-2-2.png" />
                </div>
            </div>
            <div class="max-w-7xl md:grid md:grid-cols-3 gap-8">
                <div class="col-span-2">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">03. Home & Lifestyle</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">Towels, Bed Sheets, and Cushion Covers  We create custom printed products for home and travel: beach towels, bed sheets, cushion covers, and more. Soft, washable, and made for everyday use or creative projects.</p>
                    </div>
                </div>
                <div class="">
                    <img src="/images/services-2-3.png" />
                </div>
            </div>
            <div class="max-w-7xl md:grid md:grid-cols-3 gap-8">
                <div class="col-span-2">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">04. Flat Fabric Printing</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">Print Your Own Fabric  We print your designs directly on fabric by the meter. Perfect for sewing studios, fashion designers, or anyone who wants to make their own products. Cotton, poly blends, and more.</p>
                    </div>
                </div>
                <div class="">
                    <img src="/images/services-2-4.png" />
                </div>
            </div>



        </div>

    </section>

    <section class="py-8 lg:py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto px-8">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">An Easy, Stress-Free Process</h1>



        <div class="md:grid md:grid-cols-2 gap-8 w-full">
            <div class="">
                <div class="">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">1. Choose What You Need</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">Browse our full range of garments, accessories, and fabric options. Whether you need branded uniforms, workshop-ready blanks, or printed items for events — we’ve got the options ready.</p>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">2. Request a Quick Quote</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">Send us your requirements and receive a clear, transparent quote tailored to your needs. Our team will support you with advice on materials, print options, and pricing that fits your goals.</p>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">3. We Print and Deliver</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">Once your order is confirmed, we begin printing using high-quality, reliable methods. Orders are delivered to your office or workshop — on time and ready to use.</p>
                    </div>
                </div>

            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">4. Use or Distribute with Confidence</h1>
                        <p class="mt-3 text-xl leading-relaxed text-slate-400">Distribute to your team, partners, or event attendees with confidence. Whether it’s internal use or public giveaways, our merch holds up — and reflects your organization’s quality.</p>
                    </div>
                </div>

            </div>



        </div>

    </section>


    <section class="py-8 lg:py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto px-8">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Let’s Go</h1>

        <div class="text-xl text-slate-400 leading-relaxed text-center">It's time to simplify your merch process. With clear pricing, fast production, and dedicated support, Hay Ink helps you get high-quality custom merch — without the stress.</div>

    </section>

    <section class="py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">FAQ</h1>


            <div class="w-full px-4 py-10">

                <div class="space-y-4 max-w-none w-full">

                    <!-- FAQ Item -->
                    <div x-data="{ open: false }" class="border rounded-lg bg-white w-full shadow-sm overflow-hidden">
                        <button
                            @click="open = !open"
                            class="w-full flex justify-between items-center px-6 py-4 text-left focus:outline-none">
                            <span class="font-medium text-lg">1. Choose What You Need</span>
                            <svg
                                :class="{ 'rotate-180': open }"
                                class="w-5 h-5 transform transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="max-h-0 opacity-0"
                            x-transition:enter-end="max-h-40 opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="max-h-40 opacity-100"
                            x-transition:leave-end="max-h-0 opacity-0"
                            class="px-6 pb-4 text-gray-600 text-sm overflow-hidden"
                            style="">
                            Browse our full range of garments, accessories, and fabric options. Whether you need branded uniforms, workshop-ready blanks, or printed items for events — we’ve got the options ready.
                        </div>
                    </div>

                    <!-- Another FAQ Item -->
                    <div x-data="{ open: false }" class="border rounded-lg bg-white w-full shadow-sm overflow-hidden">
                        <button
                            @click="open = !open"
                            class="w-full flex justify-between items-center px-6 py-4 text-left focus:outline-none">
                            <span class="font-medium text-lg">2. Request a Quick Quote</span>
                            <svg
                                :class="{ 'rotate-180': open }"
                                class="w-5 h-5 transform transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="max-h-0 opacity-0"
                            x-transition:enter-end="max-h-40 opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="max-h-40 opacity-100"
                            x-transition:leave-end="max-h-0 opacity-0"
                            class="px-6 pb-4 text-gray-600 text-sm overflow-hidden"
                            style="">
                            Send us your requirements and receive a clear, transparent quote tailored to your needs. Our team will support you with advice on materials, print options, and pricing that fits your goals.
                        </div>
                    </div>



                    <div x-data="{ open: false }" class="border rounded-lg bg-white w-full shadow-sm overflow-hidden">
                        <button
                            @click="open = !open"
                            class="w-full flex justify-between items-center px-6 py-4 text-left focus:outline-none">
                            <span class="font-medium text-lg">3. We Print and Deliver</span>
                            <svg
                                :class="{ 'rotate-180': open }"
                                class="w-5 h-5 transform transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="max-h-0 opacity-0"
                            x-transition:enter-end="max-h-40 opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="max-h-40 opacity-100"
                            x-transition:leave-end="max-h-0 opacity-0"
                            class="px-6 pb-4 text-gray-600 text-sm overflow-hidden"
                            style="">
                            Once your order is confirmed, we begin printing using high-quality, reliable methods. Orders are delivered to your office or workshop — on time and ready to use.
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="border rounded-lg bg-white w-full shadow-sm overflow-hidden">
                        <button
                            @click="open = !open"
                            class="w-full flex justify-between items-center px-6 py-4 text-left focus:outline-none">
                            <span class="font-medium text-lg">4. Use or Distribute with Confidence</span>
                            <svg
                                :class="{ 'rotate-180': open }"
                                class="w-5 h-5 transform transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="max-h-0 opacity-0"
                            x-transition:enter-end="max-h-40 opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="max-h-40 opacity-100"
                            x-transition:leave-end="max-h-0 opacity-0"
                            class="px-6 pb-4 text-gray-600 text-sm overflow-hidden pb-8"
                            style="">
                            Distribute to your team, partners, or event attendees with confidence. Whether it’s internal use or public giveaways, our merch holds up — and reflects your organization’s quality.
                        </div>
                    </div>

                </div>
            </div>


    </section>
</div>
@endsection
