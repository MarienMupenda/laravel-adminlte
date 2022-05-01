@extends('adminlte::page')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="box_header m-0">

                        <div class="erning_btn d-flex">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm"><i
                                    class="fas fa-chevron-left"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container rounded mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <img id="img-view" width="150px" height="auto" src="{{$product->image_small()}}"
                                         class="img-fluid m-3">
                                    <form method="post" class="pull-right"
                                          action="{{route('products.destroy',$product)}}">
                                        @csrf @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger btn-icon btn-icon-start w-100 w-md-auto float-right">
                                            <i class="fa fa-trash"></i>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
                                </div>


                            </div>
                            <div class="col-md-9">
                                <div class="p-3 py-5">
                                    <form action="{{route("products.update",$product)}}" enctype="multipart/form-data"
                                          method="POST" class="form-horizontal">
                                        @csrf @method('PUT')


                                        <div class="row form-group">
                                            <div class="col">
                                                <label for="text-input"
                                                       class=" form-control-label">{{__('Name')}}</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" id="text-input" name="name"
                                                       value="{{$product->name}}" placeholder="Text"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <label for="text-input"
                                                       class=" form-control-label">{{__('Image')}}</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="file" id="img-file"
                                                       accept="image/x-png,image/gif,image/jpeg" name="image"
                                                       class="form-control form-control-file mb-2">

                                                <input name="image_url" onpaste="return true;" type="url"
                                                       id="img-url" placeholder="https://" class="form-control">
                                            </div>

                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <label for="text-input"
                                                       class=" form-control-label">{{__('Description')}}</label>
                                            </div>
                                            <div class="col-12">
                                                    <textarea minlength="1O" maxlength="600" onpaste="return true;"
                                                              class="form-control" rows="5" type="text" id="text-inputx"
                                                              name="description">{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-lg-3">
                                                <label for="email-input"
                                                       class=" form-control-label">{{__('Category')}}</label>
                                            </div>
                                            <div class="col-12">
                                                <select name="category" id="select"
                                                        class="form-control form-select">
                                                    @foreach($categories as $category)
                                                        @if($category->id == $product->category->id)
                                                            <option selected
                                                                    value="{{$category->id}}">{{$category->name}} *
                                                            </option>
                                                        @else
                                                            <option
                                                                value="{{$category->id}}">{{$category->name}} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row form-group">
                                            <div class="col col-lg-2">
                                                <label for="email-input"
                                                       class=" form-control-label">{{__('Unit')}}</label>
                                            </div>
                                            <div class="col-12 col-lg-10">
                                                <select name="unit" id="select" class="form-control form-select">
                                                    @foreach($units as $unit)
                                                        @if($unit->name == $product->unit)
                                                            <option selected value="{{$unit->id}}">{{$unit->name}}*
                                                            </option>
                                                        @else
                                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row form-group">
                                            <div class="col col-lg-2">
                                                <label for="text-input" class=" form-control-label">Prix</label>
                                            </div>
                                            <div class="col-12 col-lg-10">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text">{{auth()->user()->currency()}}</span>
                                                    </div>
                                                    <input type="text" id="amount" name="pv"
                                                           value="{{$product->selling_price}}" placeholder=".."
                                                           class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <button type="submit" class="btn btn-primary profile-button">
                                                <i class="fa fa-save"></i> {{__('Save')}}
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
