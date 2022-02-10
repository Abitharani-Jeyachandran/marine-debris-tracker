@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <ol class="d-flex breadcrumb bg-transparent p-0 justify-content-end">
            <li class="breadcrumb-item text-capitalize"><a href="/">Home</a></li>
            <li class="breadcrumb-item text-capitalize"><a href="{{route('admin.index')}}">Admins</a></li>
            <li class="breadcrumb-item text-capitalize active" aria-current="page">View Admin</li>
        </ol>
    </div>
</div>
<section class="content">
    {{-- <div class="container-fluid"> --}}
        <div class="container">
            <main class="mx-auto m-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>View Admin</h4>
                                    </div>
                                    <div>
                                        <a href="{{route('admin.index')}}" class="btn btn-lg btn-warning float-end">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-item">
                                    <table class="table-list-view">
                                        <tr>
                                        <td><strong>Name</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$admin->displayName}}</td>
                                        </tr>
                                        <tr>
                                        <td><strong>Email / Phone</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$admin->email == null ? $admin->phoneNumber : $admin->email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
@endsection
