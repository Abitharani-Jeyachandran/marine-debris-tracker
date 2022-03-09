@extends('layouts.admin')
@section('content')
<div class="container">
    <main class="mx-auto m-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Zone</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                    <tr>
                                        <th style="width: 100%" class="bg-danger">Red Zone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reds as $item)
                                        <tr>
                                        <td>{{$item}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                    <tr>
                                        <th style="width: 100%" class="bg-primary">Blue Zone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blues as $item)
                                        <tr>
                                        <td>{{$item}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection


@push('scripts')
<script>

</script>
@endpush
