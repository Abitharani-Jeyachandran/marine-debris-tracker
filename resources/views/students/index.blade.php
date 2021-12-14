@extends('layouts.app')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student List

                            <a href="{{route('students.create')}}" class="btn btn-lg btn-primary float-end">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered border-primary">
                            <thead>
                              <tr>
                                <th style="width: 25%">First NAme</th>
                                <th style="width: 25%">Last Name</th>
                                <th style="width: 25%">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($students)
                                @foreach ($students as $key => $value)
                                <tr>
                                    <td style="width: 25%">{{$value['firstname']}}</td>
                                    <td style="width: 25%">{{$value['lastname']}}</td>
                                    <td style="width: 25%">
                                        <a class="btn btn-md btn-success" href="{{route('students.show',$key)}}"><i class="fas fa-eye"></i> Show</a>
                                        <a class="btn btn-md btn-warning" href="{{route('students.edit',$key)}}"><i class="fas fa-pen"></i> Edit</a>
                                        <button  onclick="deleteConfirmation()" class="btn btn-md btn-danger mr-1"><i class="fas fa-trash"></i> Delete</button>
                                        <form action="{{route('students.destroy',$key)}}" method="post" id='form-data'>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <th colspan="3">No Record</th>
                                </tr>
                                @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    function deleteConfirmation(){
        Swal.fire({
                  title: 'Are you sure?',
                  html: "You want to delete this record" ,
                  icon:  'error',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: "Yes, Delete it!"
                }).then((result) => {
                  if (result.isConfirmed) {
                   $('#form-data').submit();
                  }
                })
      }
</script>
@endpush
