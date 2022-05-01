@extends('adminlte::page')
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body card-block">
            <form action="{{route("products.store")}}" enctype="multipart/form-data" method="POST"
                  class="form-horizontal">
                @csrf @method('POST')
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class="form-control-label">{{__('Name')}}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="text-input" required name="name" placeholder="Nom du produit"
                               class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">{{__('Description')}}</label>
                    </div>
                    <div class="col-12 col-md-9">
                            <textarea onpaste="return true;" minlength="1O" maxlength="600" class="form-control"
                                      rows="3" type="text" id="text-input" name="description"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="email-input" class=" form-control-label">{{__('Category')}}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="category_id" id="select" class="form-control form-select">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="email-input" class=" form-control-label">CodeBar</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="mb-3 input-group">

                            <input readonly type="number" id="barcode" name="barcode"
                                   placeholder="Scanner le produit pour remplir" class="form-control">

                            <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-barcode"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="email-input" class=" form-control-label">{{__('Unit')}}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="unit_id" id="select" class="form-control form-select">
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">Prix</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{auth()->user()->currency()}}</span>
                            </div>
                            <input required type="number" id="amount" name="selling_price" placeholder=".."
                                   class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="text-input" class=" form-control-label">{{__('Image')}}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="file" id="text-input" accept="image/x-png,image/gif,image/jpeg" name="image"
                               class="form-control form-control-file">
                    </div>

                </div>


                <div class="card-footer">
                    <a href="{{route("items.index")}}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-chevron-left"></i> {{__('Back')}}
                    </a>
                    <button type="submit" class="float-right btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> {{__('Save')}}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('vendor/onscan.js/onscan.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
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
@stop