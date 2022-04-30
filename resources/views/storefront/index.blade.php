@extends('storefront._layouts.master')

@section('meta_tags')
<link rel="canonical" href="{{url('/')}}">
<meta name="description" content="Nous vulgarisons les produits et services made in congo🇨🇩 et nous rendons possible la vente en ligne ainsi que la gestion à distance">

<!-- Favicon-->
<link rel="shortcut icon" href="{{asset('images/icons/logo.png')}}">

<!--  SEO -->
<meta property="fb:app_id" content="444914197218751">
<meta property="og:title" content="Uzaraka - La simplicité dans vos achats et ventes">
<meta property="og:type" content="website">
<meta property="og:description" content="Nous vulgarisons les produits et services made in congo🇨🇩 et nous rendons possible la vente en ligne ainsi que la gestion à distance">
<meta property="og:image" content="{{asset('images/icons/logo.png')}}">
<meta property="og:url" content="{{url('/')}}">
<meta name="twitter:card" content="{{asset('images/icons/logo.png')}}">
@endsection


@section('body')

<div class="container px-6 mx-auto">
    <div class="h-64 overflow-hidden bg-center bg-cover rounded-md" style="background-image: url('images/front/pexels-kindel-media-6994306.jpg')">
        <div class="flex items-center h-full bg-gray-900 bg-opacity-50">
            <div class="max-w-xl px-10">
                <h2 class="text-2xl font-semibold text-white">Vos clients meritent ce qu'il y a de mieux !</h2>
                <p class="mt-2 text-gray-400">Donnez une chance à votre business d'etre decouvert en exposant gratuitemet vos produits et services sur notre plateforme.
                </p>
                <button class="flex items-center px-3 py-2 mt-4 text-sm font-medium text-white uppercase bg-purple-600 rounded hover:bg-purple-500 focus:outline-none focus:bg-purple-500">
                    <span>Joindre</span>
                    <svg class="w-5 h-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="mt-16">
        <h3 class="text-2xl font-medium text-gray-600">Top</h3>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($page->topItems as $item)
            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                <div onclick="location.href='{{ route('storefront.items.show',$item) }}'" class="flex items-end justify-end w-full h-56 bg-cover" style="cursor:pointer; background-image: url('{{ $item->image() }}')">
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
    <div class="mt-16">
        <h3 class="text-2xl font-medium text-gray-600">Recents</h3>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($page->topItems as $item)
            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                <div onclick="location.href='{{ route('storefront.items.show',$item) }}'" class="flex items-end justify-end w-full h-56 bg-cover" style="cursor:pointer; background-image: url('{{ $item->image() }}')">
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

    <div class="mt-8 md:flex md:-mx-4">
        <div class="w-full h-64 overflow-idden bg-center bg-cover rounded-md md:mx-4 md:w-1/2" style="background-image: url('/images/front/pexels-pixabay-45202.jpg')">
            <div class="flex items-center h-full bg-gray-900 bg-opacity-50">
                <div class="max-w-xl px-10">
                    <h2 class="text-2xl font-semibold text-white">Vos produits</h2>
                    <p hidden class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                    <button class="flex items-center mt-4 text-sm font-medium text-white uppercase rounded hover:underline focus:outline-none">
                        <span>Explorer</span>
                        <svg class="w-5 h-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="w-full h-64 mt-8 overflow-hidden bg-center bg-cover rounded-md md:mx-4 md:mt-0 md:w-1/2" style="background-image: url('/images/front/pexels-shattha-pilabut-135620.jpg')">
            <div class="flex items-center h-full bg-gray-900 bg-opacity-50">
                <div class="max-w-xl px-10">
                    <h2 class="text-2xl font-semibold text-white">Vos entreprises</h2>
                    <p hidden class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                    <button class="flex items-center mt-4 text-sm font-medium text-white uppercase rounded hover:underline focus:outline-none">
                        <span>Visiter</span>
                        <svg class="w-5 h-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
