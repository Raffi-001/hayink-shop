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
                <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-white">Our Artists</h1>
                <p class="mt-3 text-lg leading-relaxed text-slate-200">People who help the magic happen</p>
            </div>
        </div>
    </section>



    <section class="py-8 flex gap-8 bg-white max-w-7xl mx-auto">
        @foreach ($collections as $collection)
            <div>
            <a href="/collections/{{ $collection->translateAttribute('name') }}">
            <div class="flex flex-col gap-4 border border-primary-200 p-4">
                <div>
                    <img src="/storage/{{ $collection->translateAttribute('profile-photo') }}" class="max-w-40 max-h-40 w-40 h-40 rounded-full"/>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-center font-bold">
                        {{ $collection->translateAttribute('name') }} <br />
                    </div>
                    <div class="text-center text-sm">
                        {{ $collection->products->count() }} Designs
                    </div>
                </div>
            </div>
            </a>
            </div>
        @endforeach
    </section>



</div>
@endsection
