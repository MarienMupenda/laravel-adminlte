@extends('adminlte::page')

@section('content')
    <div  class="row">
        <div class="col-12">
            <div class="mb-5">
                <div class="row g-2">

                    <div class="col-lg-3 col-6">
                        {{-- Themes --}}
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    {{\App\Helpers\Helpers::number_format_short($earning)}}
                                    <sup style="font-size: 20px"> {{$currency}}</sup>
                                </h3>
                                <p>Recettes X</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('rapports')}}" class="small-box-footer">
                                {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$orders}}</h3>
                                <p>Commandes</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="{{route('rapports')}}" class="small-box-footer">
                                {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$items}}</h3>
                                <p>Produits</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="{{route('items.index')}}" class="small-box-footer">
                                {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$users}}</h3>
                                <p>{{ __('Users') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="{{route('users.index')}}" class="small-box-footer">
                                {{ __('More info') }} <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <h2 class="small-title">Plus vendus</h2>
            <div class="scroll-out mb-n2">
                <div class="scroll-by-count" data-count="4">
                    @foreach ($top_sold_items as $item)
                        <div class="mb-2 card">
                            <div class="row g-0 sh-14 sh-md-10">
                                <div class="col-auto">
                                    <a href="{{route('items.edit',$item)}}">
                                        <img src="{{$item->image_small()}}" alt="Photo" style="height: 50px;width:auto">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="pt-0 pb-0 card-body h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="mb-2 col-12 col-md-6 d-flex align-items-center mb-md-0">
                                                <a href="{{route('items.edit',$item)}}">{{ $item->name }}</a>
                                            </div>
                                            <div
                                                class="col-12 col-md-3 d-flex align-items-center text-muted text-medium">
                                                {{ $item->category->name??null }}
                                            </div>
                                            <div
                                                class="col-12 col-md-3 d-flex align-items-center justify-content-md-end text-muted text-medium">
                                                {{ $item->total }} Sales
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mb-5 col-xl-6">
            <div class="d-flex">
                <div class="dropdown-as-select me-3" data-setactive="false" data-childselector="span">
                    <a class="pt-0 align-top pe-0 lh-1 dropdown-toggle" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false" aria-haspopup="true">
                        <span class="small-title"></span>
                    </a>
                    <div class="dropdown-menu font-standard">
                        <div class="nav flex-column" role="tablist">
                            <a class="active dropdown-item text-medium" href="#" aria-selected="true"
                               role="tab">Today's</a>
                            <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Weekly</a>
                            <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Monthly</a>
                            <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Yearly</a>
                        </div>
                    </div>
                </div>
                <h2 class="small-title">Performance</h2>
            </div>
            <div class="card sh-45 h-xl-100-card">
                <div class="card-body h-100">
                    <div class="h-100">
                        <canvas id="horizontalTooltipChart"></canvas>
                        <div
                            class="p-3 border rounded-md opacity-0 custom-tooltip position-absolute bg-foreground border-separator pe-none d-flex z-index-1 align-items-center basic-transform-transition">
                            <div
                                class="align-middle border icon-container d-flex align-items-center justify-content-center align-self-center rounded-xl sh-5 sw-5 me-3">
                                <span class="icon"></span>
                            </div>
                            <div>
                                <span class="align-middle text d-flex text-alternate align-items-center text-small">Bread</span>
                                <span class="align-middle value d-flex text-body align-items-center cta-4">300</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-4 gy-5">
        <div class="mb-5 col-xl-6">
            <h2 class="small-title">Dernières ventes</h2>
            <div class="mb-n2 scroll-out">
                <div class="scroll-by-count" data-count="6">
                    @foreach ($recent_orders as $order)
                        <div class="mb-2 card sh-15 sh-md-6">
                            <div class="pt-0 pb-0 card-body h-100">
                                <div class="row g-0 h-100 align-content-center">
                                    <div class="mb-3 col-10 col-md-4 d-flex align-items-center mb-md-0 h-md-100">
                                        <a href="{{route('sellings.show',$order)}}" class="body-link stretched-link">Order
                                            #{{$order->id}}</a>
                                    </div>
                                    <div
                                        class="mb-1 col-2 col-md-3 d-flex align-items-center text-muted mb-md-0 justify-content-end justify-content-md-start">
                                        <span class="badge bg-outline-primary me-1">{{$order->status() }}</span>
                                    </div>
                                    <div class="mb-1 col-12 col-md-2 d-flex align-items-center mb-md-0 text-alternate">
                                <span>
                                    <span class="text-small">{{$currency}}</span>
                                    {{$order->price()}}
                                </span>
                                    </div>
                                    <div
                                        class="mb-1 col-12 col-md-3 d-flex align-items-center justify-content-md-end mb-md-0 text-alternate">
                                        {{Date::parse($order->created_at)->format('d M - H:i',)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');

    </script>
@stop
