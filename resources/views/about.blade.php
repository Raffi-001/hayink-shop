@extends('layouts.static')

@section('content')
<div>
    <!-- component -->
    <!--
        Author: Surjith S M
        Twitter: @surjithctly

        Get more templates on web3templates.com
        Tailwind Play: https://play.tailwindcss.com/O0fbQqzI8M
    -->

    <section class="py-24 flex items-center min-h-screen justify-center bg-gray-100">
        <div class="mx-auto max-w-[58rem]">
            <div class="text-center">
                <p class="text-lg font-medium leading-8 text-indigo-600/95">About HayInk</p>
                <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-black">Celebrating Armenian Creativity, One Print at a Time</h1>
                <p class="mt-3 text-lg leading-relaxed text-slate-400">we celebrate creativity and empower Armenian artists by bringing their art to life</p>
            </div>

            <div class="mt-6 flex items-center justify-center gap-4">
                <a href="#" class="transform rounded-md bg-indigo-600/95 px-5 py-3 font-medium text-white transition-colors hover:bg-indigo-700">Meet the Artists</a>
            </div>
        </div>
    </section>

    <section class="py-24 flex flex-col items-center gap-8 bg-white">
        <div class="max-w-7xl grid grid-cols-3 gap-8">
            <div class="">
                <img src="https://picsum.photos/300/300" />
            </div>
            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Why We Started Hay Ink</h1>
                    <p class="mt-3 text-2xl leading-relaxed text-slate-400">We empower Armenian artists by turning their work into wearable art. Born in Yerevan in 2022, HayInk makes creative expression easy, affordable and high-quality.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl grid grid-cols-3 gap-8">

            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">A Legacy of Craftsmanship</h1>
                    <p class="mt-3 text-2xl leading-relaxed text-slate-400">Our roots in textile printing run deep, spanning over three decades of industry expertise and craftsmanship.</p>
                </div>
            </div>
            <div class="">
                <img src="https://picsum.photos/300/300" />
            </div>
        </div>
    </section>

    <section class="py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Why Choose HayInk?</h1>

        <div class="grid grid-cols-3 gap-8 w-full">
            <div class="flex flex-col gap-4 text-center">
                <div class="flex justify-center">
                    <img src="https://picsum.photos/100/100" />
                </div>
                <h2 class="text-2xl font-bold text-center">Quality Assurance</h2>
                <p class="text-xl text-slate-400">Our state-of-the-art printing techniques guarantee long-lasting, detailed, and vivid prints</p>
            </div>
            <div class="flex flex-col gap-4 text-center">
                <div class="flex justify-center">
                    <img src="https://picsum.photos/100/100" />
                </div>
                <h2 class="text-2xl font-bold text-center">Quality Assurance</h2>
                <p class="text-xl text-slate-400">We simplify the process for artists, handling printing, logistics, and delivery</p>
            </div>
            <div class="flex flex-col gap-4 text-center">
                <div class="flex justify-center">
                    <img src="https://picsum.photos/100/100" />
                </div>
                <h2 class="text-2xl font-bold text-center">Quality Assurance</h2>
                <p class="text-xl text-slate-400">Your purchase directly supports local Armenian artists, fostering their growth and visibility</p>
            </div>
        </div>

    </section>
    <section class="py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">About HayInk</h1>

        <div class="text-xl text-slate-400 leading-relaxed">
            At Hay Ink, we celebrate creativity and empower Armenian artists by bringing their art to life. With over 30 years of hands-on experience in textile printing, our journey officially began in Yerevan, Armenia, in 2022, with a mission to help local artists overcome challenges in producing their own merchandise.
            We noticed how talented Armenian artists struggled to find accessible and affordable ways to showcase their artwork on high-quality products. Recognizing this gap, we established Hay Ink as a dedicated platform for artists to easily turn their creations into vibrant apparel, accessories, and much more.
        </div>

    </section>

    <section class="py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Our Story</h1>

        <div class="text-xl text-slate-400 leading-relaxed">
            <p>
                Our roots in textile printing run deep—spanning over three decades of industry expertise and craftsmanship. Built on the foundation of family tradition, our extensive experience allows us to deliver exceptional quality in every print. At Hay Ink, we combine proven techniques with advanced technologies like Direct-to-Film (DTF),  Direct-to-Garment (DTG) printing and sublimation printing  to ensure every product meets the highest standards of durability, detail, and color vibrancy.
            </p>
            <p>

            </p>
        </div>

    </section>
</div>
@endsection
