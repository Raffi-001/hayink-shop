@extends('layouts.static')

@section('content')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <section class="py-24 flex items-center justify-center bg-primary-100" style="background: linear-gradient(
          rgba(0, 0, 0, 0.7),
          rgba(0, 0, 0, 0.7)
        ), url('/images/thankyou-header.png'); background-size: cover; background-position-y: top;">
        <div class="mx-auto max-w-[58rem] text-center">
            <p class="text-lg font-medium leading-8 text-slate-200">Thank you for your submission</p>
            <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-white">Your Design Has Been Received</h1>
            <p class="mt-3 text-lg leading-relaxed text-slate-200">Our team will review your custom T-shirt design and get in touch shortly.</p>

            <div class="mt-6 flex items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="transform rounded-md bg-primary-500 px-5 py-3 font-medium text-white transition-colors hover:bg-primary-600">Back to Shop</a>
                <a href="{{ route('contact-us.view') }}" class="transform rounded-md bg-white px-5 py-3 font-medium text-primary-600 transition-colors hover:bg-slate-100">Contact Us</a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white flex flex-col items-center gap-16 max-w-6xl mx-auto px-6 lg:px-12 text-center">
        <h2 class="text-3xl lg:text-[2.5rem] font-bold tracking-tight text-black">
            What Happens Next?
        </h2>

        <div class="grid md:grid-cols-3 gap-16 lg:gap-20 text-slate-500 text-lg leading-relaxed py-8">
            <div class="flex flex-col items-center px-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" class="w-16 h-16 text-primary-500">
                    <rect x="12" y="8" width="28" height="40" rx="3" ry="3" />
                    <line x1="18" y1="16" x2="34" y2="16" />
                    <line x1="18" y1="24" x2="30" y2="24" />
                    <line x1="18" y1="32" x2="34" y2="32" />
                    <circle cx="45" cy="45" r="9" />
                    <line x1="50" y1="50" x2="58" y2="58" />
                </svg>

                <h3 class="text-xl font-semibold text-black mb-3">1. Review & Feedback</h3>
                <p class="max-w-sm">Our designers will carefully check your submission to ensure print quality and provide any feedback if needed.</p>
            </div>

            <div class="flex flex-col items-center px-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" class="w-16 h-16 text-primary-500">
                    <rect x="12" y="8" width="40" height="48" rx="3" ry="3" />
                    <path d="M24 20h16M24 28h10M24 36h16" />
                    <circle cx="46" cy="46" r="10" />
                    <path d="M41 46l3 3 6-6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <h3 class="text-xl font-semibold text-black mb-3">2. Approval & Quote</h3>
                <p class="max-w-sm">We’ll send you a quote and timeline for approval — no hidden fees, just transparent pricing and turnaround.</p>
            </div>

            <div class="flex flex-col items-center px-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" class="w-16 h-16 text-primary-500">
                    <path d="M8 20l8-8h8l8 8 8-8h8l8 8v32a4 4 0 0 1-4 4H12a4 4 0 0 1-4-4V20z" />
                    <path d="M32 24v20" stroke-linecap="round" />
                    <path d="M20 32h24" stroke-linecap="round" />
                    <path d="M44 16l2-4m-2 4l2 4M20 16l-2-4m2 4l-2 4" stroke-linecap="round" />
                </svg>
                <h3 class="text-xl font-semibold text-black mb-3">3. Production Begins</h3>
                <p class="max-w-sm">Once approved, we’ll start printing your design using premium materials — and ship straight to you.</p>
            </div>
        </div>
    </section>


    <div class="relative bg-primary-400" style="background: url('/images/bgaction.png'); background-position: center; background-size: cover;">
        <div class="absolute inset-0 bg-black/60"></div>

        <section class="relative py-24 flex flex-col items-center gap-8 max-w-7xl mx-auto text-white text-center">
            <h2 class="font-accent text-5xl max-w-4xl">Want to Submit Another Design?</h2>
            <p class="text-2xl max-w-3xl">We love seeing creativity flourish. Share another idea or explore our artist collaborations to get featured in our next collection.</p>

            <a href="/create-your-own" class="transform rounded-md bg-primary-500 px-5 py-3 font-medium text-white transition-colors hover:bg-primary-600">
                Submit Another Design
            </a>
        </section>
    </div>
@endsection
