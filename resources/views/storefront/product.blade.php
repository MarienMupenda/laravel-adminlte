@extends('storefront._layouts.master')
@section('meta_tags')
<!-- Required meta tags-->
<meta name="keywords" content="{{$item->description}}">
<meta name="description" content="{{$item->selling_price}}{{$item->company->currency->symbol}} - {{$item->description}}">
<link rel="icon" type="image/png" href="{{asset($item->imageSmall())}}">
<meta property="og:title" content="{{$item->title()}}">
<meta property="og:description" content="{{$item->selling_price}}{{$item->company->currency->symbol}} - {{$item->description}}">
<meta property="og:image" content="{{asset($item->imageSmall())}}">
<meta property="og:url" content="{{url('/items')}}/{{$item->id}}">
<meta name="twitter:card" content="{{asset($item->imageSmall())}}">

<!--  Non-Essential, But Recommended -->
<meta property="og:site_name" content="{{config('app.name','Uzaraka')}}">
<meta name="twitter:image:alt" content="{{$item->name}}">
<!--SEO ends-->
@endsection
@section('body')
<div class="container mx-auto px-6">
    <div class="md:flex md:items-center">
        <div class="w-full h-64 md:w-1/2 lg:h-96">
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ $item->image() }}" alt="{{ $item->name }}">
        </div>
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
            <h3 class="text-gray-700 uppercase text-lg">{{ $item->name }}</h3>
            <span class="text-gray-500 mt-3">{{ $item->price() }} {{ $item->getCurrency() }}</span>
            <hr class="my-3">
            <div class="mt-2">
                <label class="text-gray-700 text-sm" for="count">{{ $item->category->name }}</label>
                <div class="flex items-center mt-1">
                    {{ $item->description }}
                </div>
            </div>
            <div class="mt-3">
                <label class="text-gray-700 text-sm" for="count">Color:</label>
                <div class="flex items-center mt-1">
                    <button class="h-5 w-5 rounded-full bg-purple-200 border-2 border-purple-400 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-blue-600 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-teal-600 mr-2 focus:outline-none"></button>
                    <button class="h-5 w-5 rounded-full bg-pink-600 mr-2 focus:outline-none"></button>
                </div>
            </div>
            <div class="flex items-center mt-6">
                <a href="https://wa.me/{{$item->company->whatsapp()}}?text=Bonjour, je viens de trouver votre {{$item->category->name}} *_{{$item->name}}_* sur UZARAKA. Veuillez m'envoyer plus d'informations, notament sur la livraison car je souhaite l'acheter à *{{ $item->price() }} {{ $item->getCurrency() }}*. {{ route('storefront.items.show',$item) }}" class="px-8 py-2 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-500 focus:outline-none focus:bg-purple-500">{{__('Order Now')}}</a>
                <a href="{{ route('storefront.companies.show',$item->company) }}" class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                    <img title="{{$item->company->name}}" class="h-5 w-5" src="{{ $item->company->logo()}}">
                </a>
            </div>
        </div>
    </div>
    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Produits similaires</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($page->similarItems as $item)
            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                <div onclick="location.href='{{ route('storefront.items.show',$item) }}'" class="flex items-end justify-end w-full h-56 bg-cover" style="cursor:pointer; background-image: url('{{ $item->imageSmall() }}')">
                    <button class="p-2 rounded-full bg-purple-600 text-white mx-5 -mb-4 hover:bg-purple-500 focus:outline-none focus:bg-purple-500">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $item->name}}</h3>
                    <span class="mt-2 text-gray-500">{{ $item->price() }} {{ $item->getCurrency() }}</span>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    @endsection
