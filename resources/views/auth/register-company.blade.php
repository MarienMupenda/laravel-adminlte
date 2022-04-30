@extends('adminlte::auth.register')
@section('title','Créer un compte entreprise')
@section('auth_header', "Saisissez l'occasion en or d'offrir une expérience unique de simplicité à vos clients.")
@section('auth_body')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Entreprise') }}</label>

        <div class="col-md-12">
            <input placeholder="Nom de l'entreprise" id="name" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="phone" class="col-md-12 col-form-label text-md-left">{{ __('Telephone') }}</label>

        <div class="col-md-12">
            <input minlength="10" maxlength="13" placeholder="Numero de telephone /Whatsapp de l'entreprise" id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="business" class="col-md-12 col-form-label text-md-left">{{ __('Business') }}</label>

        <div class="col-md-12">
            <select name="business_id" id="business" class="form-control">
                @foreach ($businesses as $business)
                <option value="{{$business->id}}">{{$business->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="business" class="col-md-12 col-form-label text-md-left">{{ __('Currency') }}</label>

        <div class="col-md-12">
            <select name="currency_id" id="business" class="form-control">
                @foreach ($currencies as $currency)
                <option value="{{$currency->id}}">{{$currency->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <hr>
    <div class="form-group row">
        <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Admin') }}</label>

        <div class="col-md-12">
            <input placeholder="Nom du gestionnaire de l'entreprise" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

        <div class="col-md-12">
            <input placeholder="Adresse email du proprietaire" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

        <div class="col-md-12">
            <input id="password" placeholder="Au moins 8 caractères" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

        <div class="col-md-12">
            <input placeholder="Au moins 8 caractères" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>


    <div class="form-group row mb-0">
        <div class="col-md-4 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Enregistrement') }}
            </button>
        </div>
    </div>

</form>
@endsection
