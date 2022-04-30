<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Marien Mupenda">
    <meta name="keywords" content="SmirlBusiness, SmirlTech, Zandu">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @guest
        <title>Uzaraka - La simplisité dans vos achats et ventes</title>
        <meta name="description" content="Your all in one market place">
        <link rel="icon" type="image/png" href="{{asset('images/icons/logo.png')}}">

    @else
        <title> {{__($title ??'')}} - {{Auth::user()->company->name??'' }} -</title>
        <meta name="description" content="{{Auth::user()->company->description??''}}">
        <link rel="icon" type="image/png" href="{{asset(Auth::user()->company->logo())??''}}">

    @endguest

    @include('includes.css_top')
    @include('analytics')
</head>

<body class="animsition">

<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <!-- END HEADER MOBILE-->
@auth
    <!-- MENU SIDEBAR-->
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="container">
            <!-- HEADER DESKTOP-->

            <!-- HEADER DESKTOP-->
        @endauth
        <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                <!-- ALERT
                    @include('errors.messages')
                    -->
                    <div class="container-fluid">
                        @yield('content')
                        @include('partials.footer')
                    </div>
                    <!-- END ALERT-->
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

</div>
@yield('scripts')

@include('includes.js_bottom')

</body>

</html>
<!-- end document-->
