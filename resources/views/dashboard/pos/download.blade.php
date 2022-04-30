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
                <a href="{{route('dashboard.items.create')}}" class="white_btn3"><i class="zmdi zmdi-cloud-upload w3-xlarge"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="white_card position-relative mb_20 ">
                <div class="card-body">
                    <div class="">
                        <strong
                            class="text-white text-center bg-secondary p-1">SmirlBusiness POS</strong>
                    </div>
                    <!--end ribbon-->
                    <a href="#">
                        <img src="https://nrsplus.com/wp-content/uploads/2019/07/pos-machine-with-NRSPAY-min.png" alt=""
                             class="d-block mx-auto my-4" height="150">
                    </a>
                    <div class="row my-4">
                        <div class="col"><span class="badge_btn_3  mb-1">Windows</span> <span class="badge_btn_3  mb-1">Mac OS</span>
                            <span hidden class="badge_btn_3  mb-1">Linux</span> <a
                                href="#" class="f_w_400 color_text_3 f_s_14 d-block"></a></div>
                        <div class="col-auto">
                            <h4 class="text-dark mt-0">1.3<small
                                    class="text-muted font-14">
                                    <del>1.0.2</del>
                                </small></h4>
                        </div>
                    </div>
                    <a href="#" class="btn_2 btn-block w3-center">Telecharger</a></div>
                <!--end card-body-->
            </div>
        </div>
        <div class="col-md-6">
            <div class="white_card position-relative mb_20 ">
                <div class="card-body">
                    <div class="">
                        <strong
                            class="text-white text-center bg-danger p-1">SB POS Mobile</strong>
                    </div>
                    <a href="#">
                        <img src="https://blog.sunmi.com/wp-content/uploads/2018/06/Sunmi-P1-9-768x497.png" alt=""
                             class="d-block mx-auto my-4" height="150">
                    </a>
                    <div class="row my-4">
                        <div class="col"><span class="badge_btn_3  mb-1">Sunmi V1</span>
                            <a hidden href="#" class="f_w_400 color_text_3 f_s_14 d-block"></a></div>
                        <div class="col-auto">
                            <h4 class="text-dark mt-0">1.3<small
                                    class="text-muted font-14">
                                    <del>1.0.2</del>
                                </small></h4>
                        </div>
                    </div>
                    <a href="#" class="btn_2 btn-block w3-center">Telecharger</a></div>
                <!--end card-body-->
            </div>
        </div>
@endsection

