@extends('layouts.static')

@section('content')
    <section class="py-32 flex flex-col items-center justify-center text-center px-6 bg-green-100">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"
             stroke="currentColor" stroke-width="2.5" class="w-20 h-20 text-primary-500 mb-8">
            <circle cx="32" cy="32" r="30" />
            <path d="M20 33l8 8 16-16" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <h1 class="text-4xl font-bold text-black mb-4">Thank You for Getting in Touch</h1>
        <p class="text-lg text-slate-500 max-w-2xl leading-relaxed mb-12">
            We’ve received your message and our team will get back to you shortly.
            We appreciate your interest and look forward to assisting you.
        </p>

        <a href="{{ route('home') }}"
           class="inline-block rounded-md bg-primary-500 px-6 py-3 font-medium text-white transition-colors hover:bg-primary-600">
            Continue Shopping
        </a>
    </section>
@endsection
