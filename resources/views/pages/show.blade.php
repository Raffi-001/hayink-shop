@extends('layouts.static')

@section('content')
    <section class="py-16 px-4 sm:px-8 lg:px-16 max-w-5xl mx-auto">
        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900 mb-6">
            {{ $page->title }}
        </h1>

        <div class="prose prose-lg max-w-none text-gray-700">
            {!! $page->body !!}
        </div>
    </section>
@endsection
