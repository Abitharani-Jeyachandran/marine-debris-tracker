@extends('layouts.admin')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                        <div>
                        <h4>Users List</h4>
                        </div>
                        <!--<div>
                            <a href="{{route('users.create')}}" class="btn btn-lg btn-primary float-end">Add Student</a>
                        </div>-->
                        </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered border-primary">
                            <thead>
                              <tr>
                                <th style="width: 25%">Picture</th>
                                <th style="width: 25%">Name</th>
                                <th style="width: 25%">Phone Number</th>
                                <th style="width: 25%">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($users)
                                @foreach ($users as $key => $value)
                                <tr>
                                    <td style="width: 25%">
                                        <img src="{{ $value['profile_picture_url'] }}" alt="profile_pic" width="50%" height="20%">
                                    </td>
                                    <td style="width: 25%">{{$value['name']}}</td>
                                    <td style="width: 25%">{{$value['phone_number']}}</td>
                                    <td style="width: 25%; color:#fff">
                                        <a style="background-color:#274D6C;" class="btn btn-md" href="{{route('users.show',$value->id())}}"><i class="fas fa-eye"></i> Show</a>
                                        <!--<a class="btn btn-md btn-warning" href="{{route('users.edit',$value->id())}}"><i class="fas fa-edit"></i> Edit</a>-->
                                        <button  onclick="deleteConfirmation('{{$value->id()}}')" class="btn btn-md btn-danger mr-1"><i class="fas fa-trash"></i> Delete</button>
                                        <form action="{{route('users.destroy',$value->id())}}" method="post" id='form-data-{{$value->id()}}'>
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
    function deleteConfirmation(id){
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
                   $('#form-data-'+id).submit();
                  }
                })
      }
</script>
@endpush
