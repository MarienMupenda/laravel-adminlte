@extends('layout')

@section('content')

    <div class="page-title-container">
        <div class="row g-0">
            <div class="col-auto mb-3 mb-md-0 me-auto">
                <div class="w-auto sw-md-30">
                    <a href="{{route('home')}}" class="muted-link pb-1 d-inline-block breadcrumb-back">
                        <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                        <span class="text-small align-middle">{{__('Dasboard')}}</span>
                    </a>
                    <h1 class="mb-0 pb-0 display-4" id="title">{{$title}}</h1>
                </div>
            </div>
            <div class="w-100 d-md-none"></div>
            <div
                class="col-12 col-sm-6 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
                <a href="{{route('items.create')}}" type="button"
                   class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto">
                    <i data-cs-icon="plus"></i>
                    <span>{{__('Add')}}</span>
                </a>
                <div class="dropdown d-inline-block d-lg-none">
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-only ms-1"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                            aria-expanded="false">
                        <i data-cs-icon="sort"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end custom-sort">
                        <a class="dropdown-item sort" data-sort="name" href="#">Title</a>
                        <a class="dropdown-item sort" data-sort="email" href="#">Stock</a>
                        <a class="dropdown-item sort" data-sort="phone" href="#">Price</a>
                        <a class="dropdown-item sort" data-sort="group" href="#">Status</a>
                    </div>
                </div>
                <div class="btn-group ms-1 check-all-container-checkbox-click">
                    <div class="btn btn-outline-primary btn-custom-control p-0 ps-3 pe-2"
                         data-target="#checkboxTable">
<span class="form-check float-end">
<input type="checkbox" class="form-check-input" id="checkAll">
</span>
                    </div>
                    <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"></button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <button class="dropdown-item" id="deleteChecked" type="button">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
            <div
                class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                <input class="form-control" placeholder="Search">
                <span class="search-magnifier-icon">
<i data-cs-icon="search"></i>
</span>
                <span class="search-delete-icon d-none">
<i data-cs-icon="close"></i>
</span>
            </div>
        </div>
        <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
            <div class="d-inline-block">
                <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-delay="0" title="Print"
                        type="button">
                    <i data-cs-icon="print"></i>
                </button>
                <div class="d-inline-block">
                    <button class="btn p-0" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
<span class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown" data-bs-delay="0"
      data-bs-placement="top" data-bs-toggle="tooltip" title="Export">
<i data-cs-icon="download"></i>
</span>
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-end">
                        <button class="dropdown-item export-copy" type="button">Copy</button>
                        <button class="dropdown-item export-excel" type="button">Excel</button>
                        <button class="dropdown-item export-cvs" type="button">Cvs</button>
                    </div>
                </div>
                <div class="dropdown-as-select d-inline-block" data-childselector="span">
                    <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-bs-offset="0,3">
<span class="btn btn-foreground-alternate dropdown-toggle" data-bs-toggle="tooltip" data-bs-placement="top"
      data-bs-delay="0" title="Item Count">
10 Items
</span>
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-end">
                        <a class="dropdown-item" href="#">5 Items</a>
                        <a class="dropdown-item active" href="#">10 Items</a>
                        <a class="dropdown-item" href="#">20 Items</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <items :companyId="1"></items>

@endsection
@push('custom-css')
@endpush


