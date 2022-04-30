@extends('adminlte::page')

@section('content')
@if((auth()->user()->isAdmin() AND Auth::user()->company == $company) OR auth()->user()->isSuperAdmin())
<div class="card mb-7">
    <div class="card-body">
        <form action="{{route("dashboard.companies.update",$company)}}" enctype="multipart/form-data" method="POST" class="form-horizontal">
            @csrf @method('PUT')
            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right"></label>
                <div class="col-12 col-md-9">
                    <img class="img-thumbnail" style="height: 50px" src="{{asset($company->logo())}}">
                </div>
            </div>


            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-12 col-md-9">
                    <input placeholder="Nom de l'entreprise" id="name" type="text" class="form-control " name="name" value="{{$company->name}}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="select" class="col col-md-3 col-form-label text-md-right">Type</label>
                <div class="col-12 col-md-9">
                    <select name="business_id" id="select" class="form-control form-select">
                        @foreach($businesses as $business)
                        @if($business->id == $company->business_id)
                        <option selected value="{{$business->id}}">{{$business->name}} *
                        </option>
                        @else
                        <option value="{{$business->id}}">{{$business->name}} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">Description</label>
                <div class="col-12 col-md-9">
                    <textarea id="name" rows="5" class="form-control ckeditorx" name="description">{{$company->description}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">Logo</label>
                <div class="col-12 col-md-9">
                    <input type="file" id="text-input" accept="image/x-png,image/gif,image/jpeg" name="logo" class="form-control form-control-file">
                </div>
            </div>


            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-12 col-md-9">
                    <input id="address" type="text" class="form-control" name="address" value="{{$company->address}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="select" class="col col-md-3 col-form-label text-md-right">{{__('Currency')}}</label>
                <div class="col-12 col-md-9">
                    <select @if ($company->sellings->count()>0) readonly @endif name="currency_id" id="select" class="form-control form-select">
                        @foreach($currencies as $currency)
                        @if($currency->id == $company->currency_id)
                        <option selected value="{{$currency->id}}">{{$currency->name}} *
                        </option>
                        @else
                        @if ($company->sellings->count()==0)
                        <option value="{{$currency->id}}">{{$currency->name}}
                            @endif
                            @endif
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">RCCM</label>
                <div class="col-12 col-md-9">
                    <input id="name" type="text" class="form-control" name="rccm" value="{{$company->rccm}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">IDNAT</label>
                <div class="col-12 col-md-9">
                    <input id="name" type="text" class="form-control" name="idnat" value="{{$company->idnat}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col col-md-3 col-form-label text-md-right">Nb. Employés</label>
                <div class="col-12 col-md-9">
                    <input readonly id="name" type="text" class="form-control" value="{{$company->users->count()}}">
                </div>
            </div>

            <hr>

            <div class="card-footerx">

                <a href="{{url()->previous()}}" class="btn btn-outline-primary btn-sm ">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <button type="submit" class="btn btn-primary btn-sm float-right">
                    <i class="fa fa-save"></i> {{__('Save')}}
                </button>
            </div>

        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if($company->contact!=null)
        <form action="{{route("dashboard.contacts.update",$company->contact)}}" method="POST" class="form-horizontal">
            @csrf @method('PUT')
            @else
            <form action="{{route("dashboard.contacts.store")}}" method="POST" class="form-horizontal">
                @csrf @method('POST')
                @endif

                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"><i class="zmdi zmdi-phone"></i> <i class="zmdi zmdi-whatsapp"></i> {{ __('Tel (Whatsapp)') }} <strong class="text-danger">*</strong> </label>
                    <div class="col-12 col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">+</span>
                            </div>
                            <input placeholder="243970966587" required id="address" type="number" class="form-control" name="whatsapp" value="{{$company->contact->whatsapp??""}}">

                            <input type="hidden" class="form-control" name="company_id" value="{{$company->id}}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"><i class="zmdi zmdi-email"></i> {{ __('E-mail') }}</label>
                    <div class="col-12 col-md-9">
                        <input id="address" type="email" placeholder="contact@smirl.org" class="form-control" name="email" value="{{$company->contact->email??""}}">
                    </div>
                </div>



                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"><i class="zmdi zmdi-globe"></i> {{ __('Website') }}</label>
                    <div class="col-12 col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://</span>
                            </div>
                            <input placeholder="www.smirl.org" name="website" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$company->contact->website??""}}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"><i class="zmdi zmdi-instagram"></i> {{ __('Instagram') }}</label>
                    <div class="col-12 col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://instagram.com/</span>
                            </div>
                            <input name="instagram" placeholder="smirl_tech" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$company->contact->instagram??""}}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"><i class="zmdi zmdi-facebook-box"></i> {{ __('Facebook') }}</label>
                    <div class="col-12 col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://facebook.com/</span>
                            </div>
                            <input name="facebook" placeholder="SmirlTech" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$company->contact->facebook??""}}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"><i class="zmdi zmdi-twitter-box"></i> {{ __('Twitter') }}</label>
                    <div class="col-12 col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://twitter.com/</span>
                            </div>
                            <input placeholder="SmirlTech" name="twitter" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$company->contact->twitter??""}}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col col-md-3 col-form-label text-md-right"></i> <i class="zmdi zmdi-linkedin-box"></i> {{ __('Linkedin') }}</label>
                    <div class="col-12 col-md-9">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://linkedin.com/company/</span>
                            </div>
                            <input placeholder="smirltech" name="linkedin" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{$company->contact->linkedin??""}}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-footerx">
                    <a href="{{url()->previous()}}" class="btn btn-outline-primary btn-sm ">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm float-right">
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
