@extends('adminlte::page')

@section('content')
    @if($item->company_id == auth()->user()->company_id)
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="box_header m-0">

                            <div class="erning_btn d-flex">
                                <a href="{{ route('items.index') }}" class="btn btn-outline-primary btn-sm"><i
                                        class="fas fa-chevron-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container rounded mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-3 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <img id="img-view" width="150px" height="auto" src="{{$item->image_small()}}"
                                             class="img-fluid mt-5">
                                        @if(auth()->user()->isAdmin() and $item->sellingDetails->count()==0)
                                            <form method="post" class="pull-right"
                                                  action="{{route('items.destroy',$item)}}">
                                                @csrf @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-outline-danger btn-icon btn-icon-start w-100 w-md-auto float-right">
                                                    <i class="fa fa-trash"></i>
                                                    <span>Supprimer</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>


                                </div>
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Produit</h4>
                                        </div>
                                        <form action="{{route("items.update",$item)}}" enctype="multipart/form-data"
                                              method="POST" class="form-horizontal">
                                            @csrf @method('PUT')


                                            <div class="row form-group">
                                                <div class="col">
                                                    <label for="text-input"
                                                           class=" form-control-label">{{__('Name')}}</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" id="text-input" name="name"
                                                           value="{{$item->name}}" placeholder="Text"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div hidden class="col col-lg-3">
                                                    <label for="email-input" class=" form-control-label">CodeBar</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="input-group mb-3">

                                                        <input readonly type="number" id="barcode" name="barcode"
                                                               value="{{$item->barcode}}"
                                                               placeholder="Scanner le produit pour remplir"
                                                               class="form-control">

                                                        <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-barcode"></i>
                                                    </span>
                                                        </div>
                                                    </div>
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
                                                              name="description">{{$item->description}}</textarea>
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
                                                            @if($category->id == $item->category->id)
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
                                                            @if($unit->id == $item->unit->id)
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
                                                               value="{{$item->selling_price}}" placeholder=".."
                                                               class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            @if(auth()->user()->isAdmin())
                                                <div class="mt-5 text-center">
                                                    <button type="submit" class="btn btn-primary profile-button">
                                                        <i class="fa fa-save"></i> {{__('Save')}}
                                                    </button>
                                                </div>
                                            @endif

                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Stock</h4>
                                        </div>
                                        <form action="{{route("stocks.store")}}" method="POST" class="form-horizontal">
                                            @csrf @method('POST')

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label for="text-input"
                                                           class=" form-control-label">{{__('Quantity')}}</label>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" name="item" value="{{$item->id}}">

                                                        <input min="1" required type="number"
                                                               aria-describedby="basic-addon3" name="qty"
                                                               class="form-control">

                                                        <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3">
                                                        {{$item->qty()}} {{$item->unit->name}}
                                                    </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col">
                                                    <label for="text-input" class=" form-control-label">Prix d'achat
                                                        unitaire</label>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3">
                                                        {{auth()->user()->currency()}}
                                                    </span>
                                                        </div>

                                                        <input min="1" max="{{$item->selling_price}}" required
                                                               type="number" id="amount" name="pa"
                                                               value="{{$item->selling_price}}" class="form-control">


                                                    </div>
                                                </div>
                                            </div>
                                            @if(auth()->user()->isAdmin())
                                                <div class="mt-5 text-center">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-plus"></i> {{__('Ajouter')}}
                                                    </button>
                                                </div>
                                            @endif
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('errors.unauthorized');
    @endif
@endsection
@push('js')
    <script src="{{ asset('vendor/onscan.js/onscan.min.js') }}" charset="utf-8"></script>

    <script>
        $("#img-file").change(function () {

            const [file] = this.files
            if (file) {
                $('#img-view').attr('src', URL.createObjectURL(file));
            }
        });


        $("#img-url").change(function () {
            var input = this;
            var url = input.value;


            $.ajax({
                url: url
                , success: function (data) {

                    $('#img-view').attr('src', url)
                    input.setCustomValidity("");
                    // console.log(data)
                    // $('#data').text(data);
                    //  alert(data)
                }
                , error: function () {
                    input.setCustomValidity("Le lien doit contenir une image valide");
                    input.reportValidity();
                }
            });


        })

        function loadArticle(value) {

            $.get("{{url('/api/articles')}}/" + value, function (data, status) {
                console.log(data);
                $("#stock1").text(data.qty + " {{$item->unit->name}}");
                $("#article-id").val(data.id);
            });
        }

        $(function () {

            loadArticle($("#article").val());
            // alert('hey');
            $("#article").on("change", function () {
                loadArticle($(this).val());
            });

        });


        function decodeKey(key) {
            if (key >= 48 && key <= 57) {
                return key - 48;
            }
            //return undefined;
        }

        onScan.attachTo(document, {
            suffixKeyCodes: [13], // enter-key expected at the end of a scan
            reactToPaste: false
            , onScan: function (sCode) { // Alternative to document.addEventListener('scan')

                $('#barcode').val(sCode);

                console.log('Scanned: ' + sCode);
            }
            , keyCodeMapper: function (oEvent) {
                var key = decodeKey(oEvent.which);

                if (key !== undefined) {
                    return key;
                }
                // Fall back to the default decoder in all other cases
                return onScan.decodeKeyEvent(oEvent);
            }
            , onKeyDetect: function (iKeyCode) { // output all potentially relevant key events - great for debugging!
                console.log('Pressed: ' + iKeyCode);
            }

        });

    </script>

@endpush
