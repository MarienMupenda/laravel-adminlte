@extends('adminlte::page')
@section('content')
{{-- Minimal with title, text and icon --}}

<div class="row">
@foreach($companies as $company)
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('admin.companies.edit',$company)}}">
            <x-adminlte-info-box title="{{ $company->name }}" text="Entreprise" icon="fas fa-lg fa-store" icon-theme="purple" />
        </a>
    </div>
@endforeach
    <div class="col-md-3 col-sm-6">
@endsection
