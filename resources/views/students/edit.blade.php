@extends('layouts.app')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Student
                            <a href="{{route('students.index')}}" class="btn btn-lg btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('students.update',$key)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                              <label for="firstname" class="form-label">First Name</label>
                              <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname',$student['firstname']) }}">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname',$student['lastname'])}}">
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

