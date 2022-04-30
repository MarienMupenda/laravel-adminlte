<?php
$i = 0;
?>
@extends('adminlte::page')

@section('content')
    <div class="container-fluid p-0 ">
        <div class="page-title-container">

            <div class="row">
                <div class="col-8">
                    <div class="card card-body mb-3">
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Articles</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td><img width="50" class="img-thumbnail" src="{{$category->icon}}"></td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->items->count()}}</td>
                                        <td>{{$category->created_at->format('d M Y')}}</td>
                                        <td class="fd">
                                            <div class="w-100 d-flex justify-content-center">
                                                @if ($category->items->count()==0)
                                                    <form method="post" class="pull-right"
                                                          action="{{route('categories.destroy',$category)}}">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @if (Auth::user()->isSuperAdmin() or true)
                                                    <a href="{{route('categories.edit',$category)}}"
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        {{$categories->links()}}
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-body">
                        <form action="{{route("categories.store")}}" method="POST" class="form-horizontal">
                            @csrf @method('POST')
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="name" placeholder="{{__('Name')}}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="card-footerx">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle"></i> {{__('Add')}}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
@endsection




