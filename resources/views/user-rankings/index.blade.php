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
                        <h4>User Rankings</h4>
                        </div>
                        </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered border-primary">
                            <thead>
                              <tr>
                                <th style="width: 33%">Rank</th>
                                <th style="width: 33%">Name</th>
                                <th style="width: 33%">Count</th>
                                {{-- <th style="width: 33%">Actions</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                                @if ($datas)
                                @foreach ($datas as $key => $value)
                                <tr>
                                    <td style="width: 33%">{{$key + 1}}</td>
                                    <td style="width: 33%">
                                        <a href="{{route('user-ranking.show',$value['user_id'])}}">
                                        {{$value['user']}}
                                        </a>
                                    </td>
                                    <td style="width: 33%">{{$value['count']}}</td>
                                    {{-- <td style="width: 25%; color:#fff">
                                        <a style="background-color:#274D6C;" class="btn btn-md"
                                        href="{{route('user-ranking.show',$value['user_id'])}}"
                                        ><i class="fas fa-eye"></i> Show</a> --}}
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
