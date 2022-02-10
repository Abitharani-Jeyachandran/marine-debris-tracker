@extends('layouts.admin')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            @foreach ($datas as $key => $value)
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                        <h6>Collections of <strong>{{$key}}</strong></h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart-{{$loop->index}}"></canvas>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>
@endsection


@push('scripts')
<script>
$(function() {
    let pieDatas = {!! json_encode($datas) !!};
    let i = 0;
    Object.entries(pieDatas).forEach(entry => {
        const [key, value] = entry;
        console.log(entry);
            let pielabelValues = Object.keys(value).map((key) => [key]);
            let piedataValues = Object.keys(value).map((key) => value[key]);
            let id = '#pieChart-'+i;
            let pieCanvas = $(id);
            let pieLabels = pielabelValues;
            let colors = [];
            // for(let i=0;i<pieLabels.length;i++){
            //   colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
            // }
            colors = [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(0,0,0)'
            ];
            let pieDatasets = [{
                data: piedataValues,
                backgroundColor: colors,
                hoverOffset: 4
            }]
            let PieChart = new Chart(pieCanvas,{
                type: 'pie',
                data:{
                    labels:pieLabels,
                    datasets: pieDatasets
                },
            });
            i++;
    });
});
</script>
@endpush
