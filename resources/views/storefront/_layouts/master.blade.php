<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <meta name="author" content="Marien Mupenda">
    <meta name="keywords" content="ecommerce,congo,lubumabshi,smirltech,marketplace">
    @yield('meta_tags')

    <title>{{ $page->title }}</title>

    <!-- Icons -->
    <link href="{{ asset('vendor/zmdi/css/material-design-iconic-font.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    <script src="{{ mix('js/main.js') }}" defer></script>

    @include('analytics')
</head>
<body>
    <div x-data="{ cartOpen: false , isOpen: false }">
        @include('storefront._layouts._navbar')

        @include('storefront._layouts._cart')

        <main class="my-8">
            @yield('body')
        </main>

        @include('storefront._layouts._footer')
    </div>
</body>
</html>
