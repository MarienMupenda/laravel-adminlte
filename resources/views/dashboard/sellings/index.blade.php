<?php
$total_paid = 0;
$total = 0;
$benefice = 0;
$total_paid_j = 0;
$total_j = 0;
$benefice_j = 0;

foreach ($sellings as $selling) {
    $total += $selling->price();
    if ($selling->paid) {
        $total_paid += $selling->price();
        $benefice += ($selling->price() - $selling->initial_price());
    }
}


foreach ($sellings2 as $selling) {
    $total_j += $selling->price();
    if ($selling->paid) {
        $total_paid_j += $selling->price();
        $benefice_j += ($selling->price() - $selling->initial_price());
    }
}


?>
@extends('dashboard.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page_title_box d-flex align-items-center justify-content-between">
            <div class="page_title_left">
                <h3 class="f_s_30 f_w_700 dark_text">{{__($title)}}</h3>
                <ol class="breadcrumb page_bradcam mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{Auth::user()->company->name}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{$title}}</a></li>
                </ol>
            </div>

            <form action="{{route("dashboard.sellings.store")}}" method="POST" class="form-horizontal">
                @csrf @method('POST')

                <input type="hidden" id="text-input" name="customer" value="Client" class="form-control">

                <button type="submit" class="au-btn au-btn-icon au-btn--blue w3-red">
                    <i class="zmdi zmdi-plus"></i>{{__('Add')}}
                </button>

            </form>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-xl-12">
        <div class="white_card  mb_30">
            <div class="white_card_header ">
                <div class="box_header m-0">
                    <ul hidden class="nav  theme_menu_dropdown">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Analytics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cryptocurrency</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Campaign</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"> Ecommarce Analytics</a>
                                <a class="dropdown-item" href="#"> Sales</a>
                                <a class="dropdown-item" href="#"> Performance</a>
                            </div>
                        </li>
                    </ul>
                    <div hidden class="button_wizerd">
                        <a href="#" class="white_btn mr_5">ToDo</a>
                        <a href="#" class="white_btn">Settings</a>
                    </div>
                </div>
            </div>
            <div class="white_card_body anlite_table p-0 w3-red">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="single_analite_content">
                            <h4>Total</h4>
                            <h3>{{Auth::user()->currency()}} <span class="counter">{{number_format($total_j)}}</span>
                            </h3>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_analite_content">
                            <h4>Paid</h4>
                            <h3>{{Auth::user()->currency()}} <span class="counter">{{number_format($total_paid_j)}}</span></h3>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_analite_content">
                            <h4>Profits</h4>
                            <h3>{{Auth::user()->currency()}} <span class="counter">{{number_format($benefice_j)}}</span></h3>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single_analite_content">
                            <h4>Commandes</h4>
                            <h3><span class="counter">{{count($sellings2)}}</span></h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
            <div class="page_title_left mb_10">
                <h3 hidden class="mb-0">Overview</h3>
                <p hidden>Ventes jounalières</p>
            </div>
            <div class="page_title_right">
                <div class="dropdown CRM_dropdown  mr_5 mb_10">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{date('d M Y')}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Today</a>
                        <a class="dropdown-item" href="#">This Week</a>
                        <a class="dropdown-item" href="#">Last week</a>
                    </div>
                </div>
                <button onclick="printIt('commandes')" href="#" class="white_btn mb_10"><i class="zmdi zmdi-print"></i></button>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="row">
            <div class="col-12">
                <div class="white_card mb_30" id="commandes">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h4 class="m-0">Ventes jounalières</h4>
                            </div>
                            <div class="erning_btn d-flex">
                                <a href="#" class="small_blue_btn radius_0 border-right-0">Month</a>
                                <a href="#" class="small_blue_btn radius_0">Week</a>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="QA_table mb-0">
                                <!-- table-responsive -->
                                <table class="table lms_table_active2  ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Vendeur</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sellings as $selling)
                                        @if ($selling->paid)
                                        <tr>
                                            @else
                                        <tr class="fd" onclick="window.location.href='{{route('dashboard.sellings.show',$selling)}}'">
                                            @endif
                                            <td scope="row"> {{$selling->created_at->format('d-m-Y')}}</td>


                                            <td>{{$selling->user->name}}</td>
                                            <td>{{count($selling->sellingDetails)}}</td>
                                            <td>{{number_format($selling->price())}} {{auth()->user()->currency()}}</td>
                                            @if ($selling->paid)
                                            <td><a href="#" class="status_btn">Paid</a></td>
                                            @else
                                            <td><a href="#" class="status_btn pending_btn">Pending</a></td>
                                            @endif
                                            <td class="fd">
                                                <div class="table-data-feature">
                                                    <a href="{{route('dashboard.sellings.show',$selling)}}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Voir plus">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </a>

                                                    @if (Auth::user()->isAdmin() AND !$selling->paid)
                                                    <form method="post" class="pull-right" action="{{route('dashboard.sellings.destroy',$selling)}}">
                                                        @csrf @method('DELETE')
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="center-x">
                                    {{$sellings2->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<script>
    $(function() {
        //  alert('{{$total_paid}}');

        $('.pheader').hide();

        /*
               $('#paid').text({{$total_paid}});
            $('#nopaid').text({{$total-$total_paid}});
            $('#benefice').text({{$benefice}});
*/


    });

    function printIt(elementId) {

        $('.pheader').show();
        $('.fd').hide();

        printJS({
            printable: elementId
            , type: 'html'
            , targetStyles: ['*']
            , maxWidth: 1500
            , style: "text-align:justify"
        });

        $('.fd').show();
        $('.pheader').hide();
    }

</script>
@endpush
