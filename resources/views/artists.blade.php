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
                <h1 class="mt-3 text-[3.5rem] font-bold leading-[4rem] tracking-tight text-white">{{ __('artists.page_title') }}</h1>
                <p class="mt-3 text-lg leading-relaxed text-slate-200">{{ __('artists.page_subtitle') }}</p>
            </div>
        </div>
    </section>



    <section class="py-8 flex gap-8 bg-white max-w-7xl mx-auto">
        @foreach ($artists as $artist)
            <div>
            <a href="{{ $artist->collection }}">
            <div class="flex flex-col gap-4 border border-primary-200 p-4">
                <div class="w-40 h-40 rounded-full overflow-hidden shrink-0">
                    @if(! $artist->avatar)
                        <img
                            src="https://api.dicebear.com/7.x/bottts/png?seed={{ urlencode($artist->name) }}&scale=85"
                            alt="Artist Avatar"
                            class="w-full h-full object-cover object-center"
                        />
                    @else
                    <img
                        src="{{ $artist->avatar }}"
                        alt="Artist Avatar"
                        class="w-full h-full object-cover object-center"
                    />
                    @endif
                </div>
                <div class="flex flex-col gap-2">
                    <div class="text-center font-bold">
                        {{ $artist->name }} <br />
                    </div>
                    <div class="text-center text-sm">
                        {{ $artist->product_count }} Designs
                    </div>
                </div>
            </div>
            </a>
            </div>
        @endforeach
    </section>



</div>
@endsection
