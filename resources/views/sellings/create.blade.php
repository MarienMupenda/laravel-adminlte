@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>{{$title}}</strong>
        </div>


        <div class="card-body card-block">
            <form action="{{route("sellings.store")}}" method="POST" class="form-horizontal">
                @csrf @method('POST')
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">{{__('Client')}}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="text-input" name="customer" placeholder="Ex: Marien Mupenda"
                               class="form-control">
                    </div>
                </div>

                <div class="card-footer">

                    <a href="{{route("categories.index")}}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-chevron-left"></i> {{__('Back')}}
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> {{__('Continuer')}}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
