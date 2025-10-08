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
        ), url('/images/thankyou2-header.png'); background-size: cover; background-position-y: center;">
        <div class="mx-auto max-w-[58rem] text-center">
            <p class="text-lg font-medium leading-8 text-slate-200">Thank you for applying</p>
            <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-white">Your Artist Application Has Been Received</h1>
            <p class="mt-3 text-lg leading-relaxed text-slate-200">We’re thrilled that you want to join HayInk’s community of Armenian designers! Our team will review your application and get in touch soon.</p>

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
            <!-- Step 1 -->
            <div class="flex flex-col items-center px-4">
                <!-- Icon: Portfolio review -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" class="w-16 h-16 text-primary-500">
                    <rect x="10" y="12" width="44" height="36" rx="4" ry="4"/>
                    <circle cx="24" cy="26" r="4"/>
                    <path d="M10 40l10-10 8 8 10-10 16 16"/>
                </svg>

                <h3 class="text-xl font-semibold text-black mb-3">1. Portfolio Review</h3>
                <p class="max-w-sm">Our creative team will review your submitted designs and profile to ensure your work aligns with HayInk’s artistic quality and vision.</p>
            </div>

            <!-- Step 2 -->
            <div class="flex flex-col items-center px-4">
                <!-- Icon: Approval handshake -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" class="w-16 h-16 text-primary-500">
                    <path d="M8 34c2 2 5 2 8 0l6-6 8 8 6-6 10 10c2 2 5 2 8 0" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 18h12v-4a4 4 0 0 0-4-4H6v8h4zm38 0h10v-8h-12a4 4 0 0 0-4 4v4h6z" />
                </svg>

                <h3 class="text-xl font-semibold text-black mb-3">2. Approval & Onboarding</h3>
                <p class="max-w-sm">If accepted, you’ll receive an invitation to join our designer network, where you can upload and manage your artwork directly.</p>
            </div>

            <!-- Step 3 -->
            <div class="flex flex-col items-center px-4">
                <!-- Icon: Earnings / royalties -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" class="w-16 h-16 text-primary-500">
                    <circle cx="32" cy="32" r="24"/>
                    <path d="M32 18v28m10-14c0 5.5-4.5 10-10 10s-10-4.5-10-10 4.5-10 10-10 10 4.5 10 10z" stroke-linecap="round"/>
                    <path d="M22 48h20M22 16h20" stroke-linecap="round"/>
                </svg>

                <h3 class="text-xl font-semibold text-black mb-3">3. Start Earning</h3>
                <p class="max-w-sm">Once your designs are approved and live, you’ll earn a commission every time someone buys a product featuring your artwork.</p>
            </div>
        </div>
    </section>

    <div class="relative bg-primary-400" style="background: url('/images/thanks2-footerbg.png'); background-position: top; background-size: cover;">
        <div class="absolute inset-0 bg-black/60"></div>

        <section class="relative py-24 flex flex-col items-center gap-8 max-w-7xl mx-auto text-white text-center">
            <h2 class="font-accent text-5xl max-w-4xl">Create. Inspire. Earn.</h2>
            <p class="text-2xl max-w-3xl">Thank you for applying to join HayInk’s collective of independent Armenian artists. Together, we celebrate creativity and bring authentic art to life — one print at a time.</p>

            <a href="{{ route('home') }}" class="transform rounded-md bg-primary-500 px-5 py-3 font-medium text-white transition-colors hover:bg-primary-600">
                Explore the Shop
            </a>
        </section>
    </div>
@endsection
