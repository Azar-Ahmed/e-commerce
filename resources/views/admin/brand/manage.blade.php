@extends('admin.include.layout');
@section('page_title', 'Product Manage');
@push('custom_styles')
    <link href="{{ asset('assets/css/simulator/dashboard.css') }}" rel="stylesheet" />
    <style>
        .form-control {
            border: 0.2px solid black !important;
        }

        .form-select {
            border: 0.2px solid black !important;

        }

    </style>
@endpush
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-grow-1 bd-highlight">
                        <h1 class="mb-0 fw-bold">Brand</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{url('admin/brand')}}" class="btn btn-outline-primary">View Brand</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-2">
                        <form method="post" class="add_form"  enctype="multipart/form-data" action="{{ route('brand.save') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$id}}">
                                <div class="col-md-6 my-3">
                                    <label>Brand Name</label>
                                    <input type="text" class="form-control" name="brand" value="{{$brand}}" placeholder="Enter Brand Name" required>
                                    <span class="text-danger">@error('brand')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Image</label>
                                    @if ($image != '')
                                        <input type="file" class="form-control" name="image" value="{{$image}}" placeholder="Upload image">
                                        <img src="{{asset('/images/brand/'.$image)}}" alt="brand image" style="width: 150px" class="m-2">
                                    @else
                                        <input type="file" class="form-control" name="image" placeholder="Upload image" required>
                                    @endif
                                    <span class="text-danger">@error('image')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                            </div>
                            @if ($id > 0)
                                <button class="btn btn-success my-4">Update Brand</button>
                            @else
                                <button class="btn btn-primary my-4">Add Brand</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    
@endsection
