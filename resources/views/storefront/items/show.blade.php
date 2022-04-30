<!DOCTYPE html>
<html lang="fr" data-footer="true" data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">

    <!--SEO start-->
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Marien Mupenda">
    <meta name="keywords" content="{{$item->description}}">

    <title>{{$item->title()}}</title>
    <meta name="description" content="{{$item->selling_price}}{{$item->company->currency->symbol}} - {{$item->description}}">
    <link rel="icon" type="image/png" href="{{asset($item->image())}}">
    <meta property="og:title" content="{{$item->title()}}">
    <meta property="og:description" content="{{$item->selling_price}}{{$item->company->currency->symbol}} - {{$item->description}}">
    <meta property="og:image" content="{{asset($item->image())}}">
    <meta property="og:url" content="{{url('/items')}}/{{$item->id}}">
    <meta name="twitter:card" content="{{asset($item->image())}}">


    <!--  Non-Essential, But Recommended -->
    <meta property="og:site_name" content="{{config('app.name','Uzaraka')}}">
    <meta name="twitter:image:alt" content="{{$item->name}}">

    <!--SEO ends-->

    <link rel="preconnect" href="https://fonts.gstatic.com/">

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&amp;display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <link rel="stylesheet" href="{{asset('acorn/font/CS-Interface/style.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/vendor/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/vendor/glide.core.min.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/vendor/baguetteBox.min.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/vendor/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/vendor/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('acorn/css/main.css')}}">
    <script src="{{asset('acorn/js/base/loader.js')}}"></script>


    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding: 10px;
            /* border: 1px solid #ccc;*/
            margin: 1px;
            font-size: 30px;
            color: var(--primary);
            /*   background-color: #ccc;*/
        }

    </style>

    @include('analytics')

</head>
<body class="h-100">
    <div class="container">
        <div class="page-title-container">

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <div class="glide glide-gallery" id="glideStorefrontDetail">
                                    <span class="badge rounded-pill bg-primary me-1 position-absolute e-n2 t-4 z-index-1 py-2 px-3">{{$item->company->name}}</span>
                                    <div class="glide glide-large">
                                        <div class="glide__track" data-glide-el="track">
                                            <ul class="glide__slides gallery-glide-custom">
                                                <li class="glide__slide p-0">
                                                    <a href="{{asset($item->image())}}">
                                                        <img alt="detail" src="{{asset($item->image())}}" class="responsive border-0 rounded-md img-fluid mb-3 sh-35 sh-md-45 sh-xl-60 w-100">
                                                    </a>
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <a href="{{asset($item->image())}}">
                                                        <img alt="detail" src="{{asset($item->image())}}" class="responsive border-0 rounded-md img-fluid mb-3 sh-35 sh-md-45 sh-xl-60 w-100">
                                                    </a>
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <a href="{{asset($item->image())}}">
                                                        <img alt="detail" src="{{asset($item->image())}}" class="responsive border-0 rounded-md img-fluid mb-3 sh-35 sh-md-45 sh-xl-60 w-100">
                                                    </a>
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <a href="{{asset($item->image())}}">
                                                        <img alt="detail" src="{{asset($item->image())}}" class="responsive border-0 rounded-md img-fluid mb-3 sh-35 sh-md-45 sh-xl-60 w-100">
                                                    </a>
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <a href="{{asset($item->image())}}">
                                                        <img alt="detail" src="{{asset($item->image())}}" class="responsive border-0 rounded-md img-fluid mb-3 sh-35 sh-md-45 sh-xl-60 w-100">
                                                    </a>
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <a href="{{asset($item->image())}}">
                                                        <img alt="detail" src="{{asset($item->image())}}" class="responsive border-0 rounded-md img-fluid mb-3 sh-35 sh-md-45 sh-xl-60 w-100">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="glide glide-thumb">
                                        <div class="glide__track" data-glide-el="track">
                                            <ul class="glide__slides">
                                                <li class="glide__slide p-0">
                                                    <img alt="thumb" src="{{asset($item->image_small())}}" class="responsive rounded-md img-fluid">
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <img alt="thumb" src="{{asset($item->image_small())}}" class="responsive rounded-md img-fluid">
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <img alt="thumb" src="{{asset($item->image_small())}}" class="responsive rounded-md img-fluid">
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <img alt="thumb" src="{{asset($item->image_small())}}" class="responsive rounded-md img-fluid">
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <img alt="thumb" src="{{asset($item->image_small())}}" class="responsive rounded-md img-fluid">
                                                </li>
                                                <li class="glide__slide p-0">
                                                    <img alt="thumb" src="{{asset($item->image_small())}}" class="responsive rounded-md img-fluid">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="glide__arrows" data-glide-el="controls">
                                            <button class="btn btn-icon btn-icon-only btn-foreground hover-outline left-arrow" data-glide-dir="<">
                                                <i data-cs-icon="chevron-left"></i>
                                            </button>
                                            <button class="btn btn-icon btn-icon-only btn-foreground hover-outline right-arrow" data-glide-dir=">">
                                                <i data-cs-icon="chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-5 sh-xl-60 d-flex flex-column justify-content-between">
                                <div>
                                    <a class="mb-1 d-inline-block text-small" href="#">{{$item->category->name}}</a>
                                    <h3 class="mb-4">{{$item->name}}</h3>
                                    <div hidden class="text-muted text-overline">
                                        <del>$ 14.25</del>
                                    </div>
                                    <div class="h4"> {{$item->selling_price}}{{$item->company->currency->symbol}}</div>
                                    <div>
                                        <div class="br-wrapper br-theme-cs-icon d-inline-block">
                                            <select class="rating" name="rating" autocomplete="off" data-readonly="true" data-initial-rating="5">
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                        <div class="text-muted d-inline-block text-small align-text-top">
                                            ({{$item->visits()}} Vues)
                                        </div>
                                    </div>
                                    <p class="mt-2 mb-4 sh-11 clamp-line" data-line="4">{{$item->description}}</p>
                                    <div class="row g-3 mb-4" hidden>
                                        <div class="mb-3 col-12 col-sm-auto me-1">
                                            <label class="fw-bold form-label">Color</label>
                                            <div class="pt-1">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="inlineRadio" id="inlineRadio1">
                                                    <label class="form-check-label" for="inlineRadio1">Red</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="inlineRadio" id="inlineRadio2">
                                                    <label class="form-check-label" for="inlineRadio2">Blue</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-auto me-1">
                                            <label class="fw-bold form-label">Size</label>
                                            <select class="sw-10 select-single-no-search">
                                                <option selected="selected">Pick</option>
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                                <option>XL</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-auto">
                                            <label class="fw-bold form-label">Quantity</label>
                                            <select class="sw-10 select-single-no-search">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a class="btn btn-icon btn-icon-end btn-outline-primary me-sm-1 mb-1 mb-sm-0 w-100 w-sm-auto" href="https://wa.me/{{$item->company->whatsapp()}}?text={{url('/items')}}/{{$item->id}}">
                                        <span>Contacter {{$item->company->name}}</span>
                                        <i class="fab fa-whatsapp"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="col-12 container mt-7 w-100 w-sm-auto">
                                {!! $shareComponent !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/vendor/select2.full.min.js"></script>
    <script src="font/CS-Line/csicons.min.js"></script>
    <script src="js/base/helpers.js"></script>
    <script src="js/base/globals.js"></script>
    <script src="js/base/nav.js"></script>
    <script src="js/base/search.js"></script>
    <script src="js/base/settings.js"></script>
    <script src="js/base/init.js"></script>
    <script src="js/cs/glide.custom.js"></script>
    <script src="js/pages/storefront.detail.js"></script>
    <script src="js/common.js"></script>
    <script src="js/scripts.js"></script>

    <script src="{{asset('acorn/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/OverlayScrollbars.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/autoComplete.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/clamp.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/baguetteBox.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/glide.min.js')}}"></script>
    <script src="{{asset('acorn/js/vendor/select2.full.min.js')}}"></script>
    <script src="{{asset('acorn/font/CS-Line/csicons.min.js')}}"></script>
    <script src="{{asset('acorn/js/base/helpers.js')}}"></script>
    <script src="{{asset('acorn/js/base/globals.js')}}"></script>
    <script src="{{asset('acorn/js/base/nav.js')}}"></script>
    <script src="{{asset('acorn/js/base/search.js')}}"></script>
    <script src="{{asset('acorn/js/base/settings.js')}}"></script>
    <script src="{{asset('acorn/js/base/init.js')}}"></script>
    <script src="{{asset('acorn/js/cs/glide.custom.js')}}"></script>
    <script src="{{asset('acorn/js/pages/storefront.detail.js')}}"></script>
    <script src="{{asset('acorn/js/common.js')}}"></script>
    <script src="{{asset('acorn/js/scripts.js')}}"></script>
</body>
</html>
