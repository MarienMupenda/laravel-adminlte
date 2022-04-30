@extends('layout')

@section('content')
    @if(auth()->user()->isAdmin())
        <div hidden class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">{{__($title)}}</h2>
                    <a href="{{route('stocks.create')}}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>{{__('Add')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="row m-t-25">
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>ID.</th>
                        <th>{{__('Item')}}</th>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('PU')}}</th>
                        <th>{{__('Stock')}}</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                        <tr onclick="window.location.href='{{route('items.edit',$stock->item)}}#bloc-stock'">
                            <td>{{$stock->id}}</td>
                            <td>{{$stock->item->name}}</td>
                            <td>{{$stock->qty}} {{$stock->item->unit->name}}</td>
                            <td>{{$stock->initial_price}} {{auth()->user()->currency()}}</td>
                            <td>{{$stock->item->qty()}} {{$stock->item->unit->name}}</td>
                            <td>{{$stock->created_at->format('d M Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>


                </table>
                <div class="center-x">
                    {{$stocks->links()}}
                </div>
            </div>
        </div>
    @else
        @include('errors.unauthorized')
    @endif
@endsection




