@extends('adminlte::page')
@section('content')
<div class="p-0 container-fluid ">
    <div class="row">
        <div class="col-12">
            <div class="card mb-7">
                <div class="card-header">
                    <div class="m-0 box_header">
                        <div class="main-title">
                            <h3 hidden class="m-0">{{__($title)}}</h3>
                        </div>
                        <div class="erning_btn d-flex">
                            <a href="{{route('dashboard.users.create')}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="mb-3 card-body">
                    <!-- table-responsive -->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Nom</td>
                                    <td>Role</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <img width="40" class="img-cir" src="{{$user->image()}}">
                                    </td>
                                    <td>
                                        <div class="table-data__info">
                                            <h6>{{ $user->name }}</h6>
                                            <span>
                                                <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{$user->role->name}}</span>

                                    </td>
                                    <td>
                                        @if (!$user->isAdmin() and auth()->user()->isAdmin())
                                        <a class="btn btn-outline-primary btn-sm" href="{{route('dashboard.users.edit',$user)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="post" class="center" action="{{route('dashboard.users.destroy',$user)}}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
