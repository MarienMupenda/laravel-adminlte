@extends('adminlte::page')

@section('content')
    @if(auth()->user()->isAdmin())
        <div class="card">
            <div class="card-header">
                <strong>{{$title}}</strong>
            </div>


            <div class="card-body card-block">
                <form action="{{route("categories.store")}}" method="POST" class="form-horizontal">
                    @csrf @method('POST')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">{{__('Name')}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="name" placeholder="Text" class="form-control">
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
        <div class="w3-container w3-card w3-margin w3-red ">
            <div class="w3-panel w3-margin">
                <p>Accès non authorisé !</p>
            </div>
        </div>
    @endif
@endsection
