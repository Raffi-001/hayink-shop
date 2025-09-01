@extends('layouts.static')

@section('content')
    <div class="p-8">
        <div class="grid grid-cols-2 mt-8 lg:grid-cols-5 gap-x-1 gap-y-8">
            @foreach($products as $product)
                    <x-product-card :product="$product" />
            @endforeach

        </div>
    </div>
@endsection
