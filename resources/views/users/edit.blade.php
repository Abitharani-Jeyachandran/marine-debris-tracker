@extends('layouts.admin')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update User
                            <a href="{{route('users.index')}}" class="btn btn-lg btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.update',$user->id())}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$userData['name']) }}">
                              </div>
                              <div class="mb-3">
                                  <label for="phone_number" class="form-label">Phone Number</label>
                                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number',$userData['phone_number']) }}">
                                </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

