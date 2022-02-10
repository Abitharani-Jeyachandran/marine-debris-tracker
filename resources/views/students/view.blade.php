@extends('layouts.admin')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View Student
                            <a href="{{route('students.index')}}" class="btn btn-lg btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="card-item">
                            <table class="table-list-view">
                                <tr>
                                  <td><strong>First Name</strong></td>
                                  <td><strong>:</strong></td>
                                  <td>{{$student['firstname']}}</td>
                                </tr>
                                <tr>
                                  <td><strong>Last Name</strong></td>
                                  <td><strong>:</strong></td>
                                  <td>{{$student['lastname']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
