@extends('layout')

@section('content')
    <?php $i = 0;$j = 0?>

    <div class="row">
        @if (!$selling->paid)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">{{$title}}</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <thead>
                                <tr>
                                    <th>Article</th>
                                    <th>Qty</th>
                                    <th>Prix</th>
                                    <th>Totat</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($selling->sellingdetails as $detail)
                                    <tr>
                                        <td>{{++$i}}. {{$detail->item->name}}</td>
                                        <td>{{$detail->qty}}</td>
                                        <td>{{$detail->item->selling_price}} {{auth()->user()->currency()}}</td>
                                        <td>
                                            <form method="post" class="pull-right"
                                                  action="{{route('selling_details.destroy',$detail)}}">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div>
                            <form method="post"
                                  action="{{route('sellings.update',$selling)}}">
                                @csrf @method('PUT')
                                <input type="hidden" value="1" name="paid">
                                @if ($selling->sellingDetails->count()>0)
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-shopping-cart fa-lg"></i>&nbsp;
                                        <span
                                            id="payment-button-amount">VALIDER ({{number_format($selling->price())}} {{auth()->user()->currency()}})</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
                                @endif

                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Remplir la</strong>
                        <small>{{$title}}</small>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route("selling_details.store")}}" method="POST"
                              class="form-horizontal">
                            @csrf @method('POST')
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">{{__('Category')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="item" id="categories" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">

                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">{{__('ItemResource')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="item" id="items" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">{{__('Price')}}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money" id="currency">{{auth()->user()->currency()}}</i>
                                        </div>
                                        <input type="hidden" id="iprice" name="iprice">
                                        <input readonly type="text" id="price" name="price" placeholder=".."
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
                                        <input required type="number" id="stock3" name="qty" placeholder=""
                                               class="form-control">
                                        <div id="stock1" class="input-group-addon"></div>
                                        <input type="hidden" id="stock2" name="stock">

                                    </div>
                                </div>

                            </div>


                            <input type="hidden" id="text-input" name="selling" value="{{$selling->id}}">

                            <div class="card-footer">

                                <a href="{{route("dashboard")}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-chevron-left"></i> {{__('Back')}}
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-cart-plus"></i> {{__('Add')}}
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('home')}}" class="btn btn-lg btn-outline-primary">
                            <i class="fa fa-chevron-left fa-lg"></i>&nbsp;
                            <span
                                id="payment-button-amount">{{__('Retour')}}</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </a>
                        <button onclick="printIt('factPrint')" id="payment-button"
                                class="btn btn-lg btn-warning">
                            <i class="zmdi zmdi-print zmdi-hc-lg"></i>&nbsp;
                            <span
                                id="payment-button-amount">IMPRIMER</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>

                    </div>
                    <div class="card-body card-block w3-text-black">
                        <div id="factPrint">
                            <div class="text-center">
                                <img width="150px" src="{{asset(auth()->user()->company->logo)}}"
                                     alt="{{auth()->user()->company->name}}">
                            </div>
                            <br>
                            <h2 hidden class="text-center">{{auth()->user()->company->name}}</h2>
                            <div class="text-center">RCCM: {{auth()->user()->company->rccm}}
                                <br>IDNAT: {{auth()->user()->company->idnat}}<br>{{auth()->user()->company->address}}
                            </div>
                            <br>
                            <h4 class="text-center"> No.{{$selling->makeInvoice()}}</h4>
                            <br>
                            <div>Date : {{$selling->created_at}}</div>
                            <div>Client : <strong>{{$selling->customer}}</strong></div>
                            <div>Caissier : <strong>{{$selling->user->name}}</strong></div>
                            <hr>
                            <div class="">
                                <table class="table table-borderless w3-text-black">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Designation</th>
                                        <th>Qté</th>
                                        <th>Montant</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($selling->sellingdetails as $detail)
                                        <tr>
                                            <td>{{++$j}}</td>
                                            <td>{{$detail->item->name}}</td>
                                            <td>{{$detail->qty}}</td>
                                            <td>{{number_format($detail->item->selling_price)}} {{auth()->user()->currency()}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <br>
                            <br>
                            <hr>
                            <div class="text-right">Total :
                                <strong>{{number_format($selling->price())}} {{auth()->user()->currency()}}</strong>
                            </div>
                            <br>
                            <div class="text-justify">
                                <i>* Les marchandises vendues ne sont ni reprises ni echangées.</i>
                            </div>
                            <br>
                            <br>
                            <div class="text-center"></div>
                            <div class="text-center">
                                ==== Merci et bienvenu encore ! ==== <br>
                                <img hidden width="100px" src="{{asset('images/icons/logo.png')}}" alt="SmirlTech">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- selling modal small -->


    <!-- end selling modal small -->

@endsection
@push('scripts')
    <script src="{{ asset('vendor/onscan.js/onscan.min.js') }}" charset="utf-8"></script>
    <script>

        function decodeKey(key) {
            if (key >= 48 && key <= 57) {
                return key - 48;
            }
            //return undefined;
        }

        function findByCode(sCode) {
            $.get("{{url('/api/item')}}/" + sCode + "/" + {{Auth::user()->company_id}}, function (data, status) {

                console.log(data);

                if (data) {

                    $("#price").val(data.selling_price);
                    $("#stock1").text(data.stock_qty + ' ' + data.u);
                    $("#stock2").val(data.stock_qty);
                    $("#stock3").val(1);

                    $("#categories").parent().parent().hide();

                    $("#items").html('<option value="' + data.id + '">' + data.name + '</option>');
                }
                //loadStock()
            });
        }

        onScan.attachTo(document, {
            suffixKeyCodes: [13], // enter-key expected at the end of a scan
            reactToPaste: true,
            onScan: function (sCode) { // Alternative to document.addEventListener('scan')


                // $('#barcode').val(sCode);

                findByCode(sCode);

                console.log('Scanned: ' + sCode);
            },
            keyCodeMapper: function (oEvent) {
                var key = decodeKey(oEvent.which);

                if (key !== undefined) {
                    return key;
                }
                // Fall back to the default decoder in all other cases
                return onScan.decodeKeyEvent(oEvent);
            },
            onKeyDetect: function (iKeyCode) { // output all potentially relevant key events - great for debugging!
                console.log('Pressed: ' + iKeyCode);
            }

        });


        $(function () {

            //  $("#factPrint").hide();

            @if (!empty(session('paid')))
            // printIt('factPrint');
            @endif


            loadItems();

            $("#categories").on("change", function () {
                loadItems();
            });
            $("#items").on("change", function () {
                loadPrice()
            });

        });

        function printIt(elementId) {
            $("#factPrint").show();

            printJS({
                printable: elementId,
                type: 'html',
                targetStyles: ['*'],
                maxWidth: 310,
                style: "text-align:justify"
            });

            //   $("#factPrint").hide();
        }

        function loadPrice() {
            var value = $("#items").val();
            $.get("{{url('/api/item')}}/" + value, function (data, status) {

                $("#price").val(data.selling_price);
                $("#iprice").val(data.initial_price);
                $("#stock1").text(data.stock_qty + ' ' + data.u);
                $("#stock2").val(data.stock_qty);
                // loadStock()
            });
        }

        function loadStock() {
            var value = $("#items").val();
            $.get("{{url('/api/item')}}/" + value, function (data, status) {


                //$("#stock3").attr('placeholder',data.stock);
            });
        }

        function loadItems() {
            var value = $("#categories").val();

            $.get("{{url('/api/items/')}}/" + value, function (data, status) {

                //alert(data[0].item_id);

                row = "";
                for (let i = 0; i < data.length; i++) {
                    item = data[i];
                    row += '<option value="' + item.id + '">' + item.name + '</option>';
                }

                $("#items").html(row);

                loadPrice();

            });
        }

    </script>

@endpush
