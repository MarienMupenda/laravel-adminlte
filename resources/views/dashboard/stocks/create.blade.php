@extends('dashboard.layout')

@section('content')
    @if(auth()->user()->isAdmin())
        <div class="card">
            <div class="card-header">
                <strong>{{$title}}</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{route("dashboard.stocks.store")}}" method="POST" class="form-horizontal">
                    @csrf @method('POST')
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">{{__('Item')}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="item" id="items" class="form-control">
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">{{__('Prix d\'achat')}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money" id="currency">{{auth()->user()->currency()}}</i>
                                </div>
                                <input type="text" id="price" name="pa" readonly value="0" placeholder=".."
                                       class="form-control">
                                <div class="input-group-addon">.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">{{__('Quantity')}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group">
                                <input type="number" id="text-input" name="qty" placeholder="" class="form-control">
                                <div id="stock1" class="input-group-addon"></div>

                            </div>
                        </div>

                    </div>



                    <div class="card-footer">

                        <a href="{{route("dashboard.stocks.index")}}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-chevron-left"></i> {{__('Back')}}
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
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
@endsection
@section('scripts')
    <script>

        function loadPrice(value) {

            $.get("{{url('/api/item')}}/" + value, function (data, status) {

                $("#price").val(data.initial_price);
                $("#stock1").text(data.stock_qty+" "+data.u);
            });
        }

        $(function () {

            loadPrice($("#items").val());
            // alert('hey');
            $("#items").on("change", function () {
                loadPrice($(this).val());
            });

        });
    </script>

@endsection
