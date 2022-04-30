@extends('adminlte::page')
@section('content_header')
<h1>{{$title}}</h1>
@stop
@section('content')
<div class="p-0 container-fluid ">
    <div class="row">
        <div class="col-12">
            <div class="card mb-7">
                <div class="card-header">
                    <div class="m-0 box_header">
                        <div class="main-title">
                            <h3 hidden class="m-0">{{__($title)}}</h3>
                        </div>
                        <div class="erning_btn d-flex">
                            <a href="{{route('dashboard.items.create')}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="mb-3 card-body">
                    <!-- <items company="{{auth()->user()->company_id}}"></items>-->
                    <!-- table-responsive -->
                    <div class="table-responsive m-b-40">
                        {{-- With buttons --}}
                        <x-adminlte-datatable id="table7" :heads="$heads" theme="light" :config="$config" striped hoverable with-buttons />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .uz-img {
        width: auto;
        height: 25px;
    }

</style>
@stop
