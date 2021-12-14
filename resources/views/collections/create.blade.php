@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <ol class="d-flex breadcrumb bg-transparent p-0 justify-content-end">
            <li class="breadcrumb-item text-capitalize"><a href="/">Home</a></li>
            <li class="breadcrumb-item text-capitalizeactive" aria-current="page"><a href="{{route('collections.index')}}">Add Collection</a></li>
        </ol>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="container">
            <main class="mx-auto m-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Add New Collection</h4>
                                    </div>
                                    <div>
                                        <a href="{{route('collections.index')}}" class="btn btn-lg btn-warning float-end">Back</a>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{route('collections.store')}}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group  col-12">
                                                <label for="category" class="col-form-label text-md-right">{{ __('Category') }}</label>
                                                <select class="form-control @error('category') is-invalid @enderror" name="category" >
                                                    <option value='category-1' {{ old('category') ? 'selected' : '' }}>category-1</option>
                                                    <option value='category-2' {{ old('category') ? 'selected' : '' }}>category-2</option>
                                                    <option value='category-3' {{ old('category') ? 'selected' : '' }}>category-3</option>
                                                </select>
                                                @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group  col-12">
                                                <label for="quantity" class="col-form-label text-md-right">{{ __('Quantity') }}</label>
                                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                                                    name="quantity" value="{{ old('quantity',) }}" placeholder="Quantity" autocomplete="off">
                                                @error('quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex align-item justify-content-end">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fas fa-save"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

@endsection

