@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <ol class="d-flex breadcrumb bg-transparent p-0 justify-content-end">
            <li class="breadcrumb-item text-capitalize"><a href="/">Home</a></li>
            <li class="breadcrumb-item text-capitalizeactive" aria-current="page"><a href="{{route('collections.index')}}">Collections</a></li>
        </ol>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="container">
            <main class="mx-auto m-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Collections Chart</h4>
                                    </div>
                                    <div>
                                        <a href="{{route('collections.index')}}" class="btn btn-lg btn-warning float-end">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(function() {
    let datas = {!! json_encode($datas) !!}
    let labelValues = Object.keys(datas).map((key) => [key]);
    let dataValues = Object.keys(datas).map((key) => datas[key]);
    let barCanvas = $('#barChart');
    let barChart = new Chart(barCanvas,{
        type:'bar',
        data:{
            labels:labelValues,
            datasets:[
                {
                   label:'Collections per Category',
                   data: dataValues
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
})
</script>
@endpush
