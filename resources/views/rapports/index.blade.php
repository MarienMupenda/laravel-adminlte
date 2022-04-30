@extends('adminlte::page')

@section('content')

    <div class="row ">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left mb_10">
                    <p class="f_s_30 f_w_700 dark_text">{{ $subTitle }} - <b class="text-primary">{{ $total }}</b></p>
                </div>
                <div class="page_title_right">
                    <div class="mr_5 mb_10 form-inline">
                        @csrf @method('GET')
                        <input id="from" onchange="readyLink()" class="form-control" type="date"
                               value="{{$from->format('Y-m-d')}}">
                        <input id="to" onchange="readyLink()" class="form-control" type="date"
                               value="{{$to->format('Y-m-d')}}">
                        <a id="href" class="btn btn-outline-primary"><i class="fa fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="w3-margin-bottom"></div>
        </div>

        <div class="col-xl-12">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-7" id="commandes">
                        <div hidden class="card-header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 hidden class="m-0">{{__($title)}}</h3>
                                </div>
                                <div class="erning_btn d-flex">
                                    <button onclick="printIt('commandes')" href="#"
                                            class="btn btn-outline-primary btn-sm"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="QA_section">
                                <div hidden class="text-center w3-margin-bottom">
                                    <div class="row text-justify w3-margin-bottom">
                                        <div class="col-lg-4">
                                            <img class="img-fluid" style="height: 100px; width: auto"
                                                 src="{{asset(auth()->user()->company->logo())}}"/>
                                        </div>
                                        <div class="col-lg-4">
                                            <strong>{{Auth::user()->company->business->name}}</strong>
                                            <div>
                                                {{ auth()->user()->company->description }}
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <strong>Information Légales</strong>
                                            <div>
                                                RCCM: {{auth()->user()->company->rccm}}
                                                <br>IDNAT: {{auth()->user()->company->idnat}}<br>Adresse
                                                : {{auth()->user()->company->address}}
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                    <h4 style="color: black">{{$title}}</h4>
                                    </p>
                                </div>
                                <div class="QA_table mb-0">
                                    <x-adminlte-datatable id="table7" :heads="$heads" theme="light" :config="$config"
                                                          with-footer striped hoverable with-buttons/>
                                    <!-- table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("js")
    <script>
        //alert('Hello Wolrd');

        function readyLink() {
            var currentUrl = window.location.origin;
            var url = currentUrl + '/rapports/' + $('#from').val() + '/' + $('#to').val();

            $("#href").attr('href', url);
            console.log(url);
        }

        function printIt(elementId) {

            $('.pheader').show();
            $('.fd').hide();

            printJS({
                printable: elementId
                , type: 'html'
                , targetStyles: ['*']
                , maxWidth: 1500
                , style: "text-align:justify"
            });

            $('.fd').show();
            $('.pheader').hide();
        }

    </script>
@endpush
