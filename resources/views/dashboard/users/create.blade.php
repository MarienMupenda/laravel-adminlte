@extends('adminlte::page')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(auth()->user()->isAdmin())
                    <div class="card">
                        <div class="card-header">
                            <strong>{{$title}}</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route("dashboard.users.store")}}" enctype="multipart/form-data" method="POST"
                                  class="form-horizontal">
                                @csrf @method('POST')

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="" id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="" id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>


                                <hr>
                                <div class="card-footerx">

                                    <a href="{{url()->previous()}}" class="btn btn-outline-primary btn-sm">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">
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
            </div>
        </div>
@endsection
