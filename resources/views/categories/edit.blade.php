@extends('adminlte::page')

@section('content')
    @if(auth()->user()->isSuperAdmin())
        <div class="card">
            <div class="card-header">
                <strong hidden>{{$category->name}}</strong>
                <img width="50" class="img-thumbnail" src="{{$category->icon}}">
            </div>


            <div class="card-body card-block">
                <form action="{{route("categories.update",$category)}}" method="POST" class="form-horizontal">
                    @csrf @method('PUT')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">{{__('Name')}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" value="{{$category->name}}" id="text-input" name="name"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">{{__('Icon')}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" value="{{$category->icon}}" id="text-input" name="icon"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="card-footer">

                        <a href="{{route("categories.index")}}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-chevron-left"></i> {{__('Back')}}
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-save"></i> {{__('Save')}}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @else
        @include('errors.unauthorized')
    @endif
@endsection
