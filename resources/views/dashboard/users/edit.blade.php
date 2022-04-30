@extends('adminlte::page')
@section('content')
    <div class="container">
    
        <div class="row">
            <div class="col-12 col-xl-4 col-xxl-3">
                <h2 hidden class="small-title">Profile</h2>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-column mb-4">
                            <div class="d-flex align-items-center flex-column">
                                <div class="sw-13 position-relative mb-3">
                                    <img src="{{asset($user->image())}}" class="img-fluid rounded-xl" alt="thumb">
                                </div>
                                <div class="h5 mb-0">{{$user->name}}</div>
                                <div class="text-muted">{{$user->role->name??''}}</div>
                                <div class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                         stroke-linejoin="round" class="cs-icon cs-icon-pin me-1">
                                        <path
                                            d="M3.5 8.49998C3.5 -0.191432 16.5 -0.191368 16.5 8.49998C16.5 12.6585 12.8256 15.9341 11.0021 17.3036C10.4026 17.7539 9.59777 17.754 8.99821 17.3037C7.17467 15.9342 3.5 12.6585 3.5 8.49998Z"></path>
                                    </svg>
                                    <span class="align-middle">Lubumbashi, RDC</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8 col-xxl-9 mb-5 tab-content">
                <div class="tab-pane fade show active" id="overviewTab" role="tabpanel">
                   
                    <h2 hidden class="small-title">Activity</h2>
                    <div class="card mb-5">
                        <div class="card-body">
                            @if((auth()->user()->isAdmin() AND !$user->isAdmin()) OR Auth::id() == $user->id)
                                <form action="{{route("dashboard.users.update",$user)}}" enctype="multipart/form-data"
                                      method="POST"
                                      class="form-horizontal">
                                    @csrf @method('PUT')

                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input placeholder="" id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                                   value="{{$user->name}}" required autocomplete="name">
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
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{$user->email}}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if((auth()->user()->isAdmin() AND Auth::id() != $user->id))
                                        <div class="form-group row">
                                            <label for="role"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                            <div class="col-md-6">
                                                <select id="role" class="form-control form-select" name="role">
                                                    @foreach ($roles as $role)
                                                        @if ($user->role_id == $role->id)
                                                            <option selected value="{{$role->id}}">{{$role->name}}*
                                                            </option>
                                                        @else
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden"  name="role" value="{{$user->role->id}}">
                                    @endif


                                    <div class="form-group row">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                        <div class="col-md-6">
                                            <input type="file" id="text-input" accept="image/x-png,image/gif,image/jpeg"
                                                   name="image"
                                                   class="form-control form-control-file">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" autocomplete="new-password">

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
                                                   name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>


                                    <hr hidden>
                                    <div class="card-footer">

                                        <a href="{{url()->previous()}}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-chevron-left"></i>
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-sm float-right">
                                            <i class="fa fa-save"></i> {{__('Save')}}
                                        </button>
                                    </div>

                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
