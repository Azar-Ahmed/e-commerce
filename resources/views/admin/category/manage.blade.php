@extends('admin.include.layout');
@section('page_title', 'Category Manage');
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
                        <h1 class="mb-0 fw-bold">Category</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{url('admin/category')}}" class="btn btn-outline-primary">View Category</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-2">
                        <form method="post" class="add_form" enctype="multipart/form-data"  action="{{ route('category.save') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$id}}">
                                <div class="col-md-6">
                                    <label>Category Name</label>
                                    <input type="text" class="form-control cat_name" name="cat_name" value="{{$cat_name}}" placeholder="Enter Category Name" required>
                                    <span class="text-danger">@error('cat_name')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label>Category Slug</label>
                                    <input type="text" class="form-control cat_slug" name="cat_slug" value="{{$cat_slug}}" placeholder="Enter Category Slug" required>
                                    @error('cat_slug')
                                    <span class="text-danger">
                                        {{$message}} 
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Image</label>
                                    @if ($image != '')
                                        <input type="file" class="form-control" name="image" value="{{$image}}" placeholder="Upload image">
                                        <img src="{{asset('/images/category/'.$image)}}" alt="category image" style="width: 150px" class="m-2">
                                    @else   
                                        <input type="file" class="form-control" name="image" placeholder="Upload image" required>
                                    @endif
                                    <span class="text-danger">@error('image')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                            </div>
                            @if ($id > 0)
                                <button class="btn btn-success add_cat my-4">Update Category</button>
                            @else
                                <button class="btn btn-primary add_cat my-4">Add Category</button>
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
