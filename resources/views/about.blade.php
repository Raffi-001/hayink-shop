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

    <section class="py-24 flex items-center justify-center bg-gray-100" style="background: linear-gradient(
          rgba(0, 0, 0, 0.7),
          rgba(0, 0, 0, 0.7)
        ), url('/images/about-header.png'); background-size: cover; background-position: center;">
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

    <section class="py-24 flex flex-col items-center gap-8 bg-white">
        <div class="max-w-7xl grid grid-cols-3 gap-8">
            <div class="">
                <img src="/images/about-1.png" />
            </div>
            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Why We Started Hay Ink</h1>
                    <p class="mt-3 text-2xl leading-relaxed text-slate-400">We began by serving the local market with high-quality textile printing, but it didn’t take long to realize something deeper. Armenian artists were struggling to turn their art into merchandise. The process was often too manual, expensive, and time-consuming, making it difficult for many creatives to make ends meet.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl grid grid-cols-3 gap-8">

            <div class="col-span-2">
                <div class="">
                    <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">A Legacy of Craftsmanship</h1>
                    <p class="mt-3 text-2xl leading-relaxed text-slate-400">
                        Our roots in textile printing run deep — spanning over three decades of hands-on experience across borders. Before launching in Armenia, we built our foundation in Syria, where our family business served countless clients with precision, reliability, and care.
                    </p>
                    <p class="mt-3 text-2xl leading-relaxed text-slate-400">
                        Today, that legacy continues with a global reach. Through long-standing relationships with suppliers across the region and in China, we combine trusted craftsmanship with international know-how to offer outstanding quality in every print. With decades of experience behind us, we bring more than just technique — we bring vision, connection, and trust.
                    </p>
                </div>
            </div>
            <div class="">
                <img src="/images/about-2.png" />
            </div>
        </div>
    </section>

    <section class="py-24 flex flex-col items-center gap-8 bg-white max-w-7xl mx-auto">

        <h1 class="mt-3 text-[2rem] font-bold tracking-tight text-black">Why Choose HayInk?</h1>

        <div class="grid grid-cols-3 gap-8 w-full">
            <div class="flex flex-col gap-4 text-center">
                <div class="flex justify-center">
                    <img src="/images/about-3.png" />
                </div>
                <h2 class="text-2xl font-bold text-center">No Corporate Vibe, Just Real People</h2>
                <p class="text-xl text-slate-400">We’re not some faceless print-on-demand factory. We’re a tight-knit team that cares about your work  and your outcome. We keep it transparent, flexible, and human.When you reach out, you talk to someone who gets you.</p>
            </div>
            <div class="flex flex-col gap-4 text-center">
                <div class="flex justify-center">
                    <img src="/images/about-4.png" />
                </div>
                <h2 class="text-2xl font-bold text-center">Artist-First Approach</h2>
                <p class="text-xl text-slate-400">Hay Ink was built to support artists. We don’t just print — we help you bring your vision to life and make your merch journey effortless.</p>
            </div>
            <div class="flex flex-col gap-4 text-center">
                <div class="flex justify-center">
                    <img src="/images/about-5.png" />
                </div>
                <h2 class="text-2xl font-bold text-center">Local Roots, Global Network</h2>
                <p class="text-xl text-slate-400">Every product is proudly printed in Armenia, using premium materials and advanced printing techniques. Backed by trusted partners across the region and in China, we combine local quality with global reach. Ensuring fast, reliable service for both small and large orders.</p>
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
