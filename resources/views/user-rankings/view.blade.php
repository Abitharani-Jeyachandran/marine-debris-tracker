@extends('layouts.admin')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>View User
                            <a href="{{route('users.index')}}" class="btn btn-sm btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="card-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{$user['profile_picture_url']}}" alt="profile_pic" width="50%">
                                </div>
                                <div class="col-md-6">
                                    <table class="table-list-view">
                                        <tr>
                                          <td><strong>Name</strong></td>
                                          <td><strong>:</strong></td>
                                          <td>{{$user['name']}}</td>
                                        </tr>
                                        <tr>
                                          <td><strong>Phone Number</strong></td>
                                          <td><strong>:</strong></td>
                                          <td>{{$user['phone_number']}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>User Collection Chart
                        </h4>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    let datas = {!! json_encode($datas) !!}
    let labelValues = Object.keys(datas).map((key) => [key]);
    let dataValues = Object.keys(datas).map((key) => datas[key]);
    let barCanvas = $('#barChart');
    let colors = [];
    for(let i=0;i<labelValues.length;i++){
      colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
    }
    let barChart = new Chart(barCanvas,{
        type:'bar',
        data:{
            labels:labelValues,
            datasets:[
                {
                   label:'Collections per Items',
                   data: dataValues,
                   backgroundColor: colors,
                   borderColor: colors,
                   borderWidth: 1
                }
            ]
        },
        options:{
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero: true
                    }
                }]
            }
        }
    })
});
</script>
@endpush
