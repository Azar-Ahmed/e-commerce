@extends('admin.include.layout');
@section('page_title', 'Product Manage');
@push('custom_styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
    <style>
        .form-control {
            border: 0.2px solid black !important;
        }

        .form-select {
            border: 0.2px solid black !important;

        }
    </style>
    <style>
        element.style {
            height: 43vh !important;
        }

        span.select2-dropdown.select2-dropdown--below {
            height: 150px !important;
        }

        .select2-container--default .select2-results>.select2-results__options {
            height: 103px !important;
        }
    </style>
@endpush
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-grow-1 bd-highlight">
                        <h1 class="mb-0 fw-bold">Product</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{ url('admin/product') }}" class="btn btn-outline-primary">View Product</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-2">
                        <form method="post" class="add_form" enctype="multipart/form-data"
                            action="{{ route('product.save') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="col-md-4 my-3">
                                    <label>Category</label>
                                    <select name="cat_id" id="cat_id" class="form-control">
                                        <option value="">Select Categories</option>
                                        @foreach ($category as $item)
                                            @if ($cat_id == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->cat_name }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('cat_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $name }}"
                                        placeholder="Enter Name" required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ $slug }}"
                                        placeholder="Enter Slug" required>
                                    <span class="text-danger">
                                        @error('slug')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Brand</label>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brand as $item)
                                            @if ($brand = $item->brand)
                                                <option value="{{ $item->brand }}" selected>{{ $item->brand }}
                                                </option>
                                            @else
                                                <option value="{{ $item->brand }}">{{ $item->brand }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('brand')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Keyword</label>
                                    <input type="text" class="form-control" name="keyword" value="{{ $keyword }}"
                                        placeholder="Enter Keyword" required>
                                    <span class="text-danger">
                                        @error('keyword')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Features</label>
                                    <input type="text" class="form-control" name="features" value="{{ $features }}"
                                        placeholder="Enter Features" required>
                                    <span class="text-danger">
                                        @error('features')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-12 my-3">
                                    <label>Description</label>
                                    <textarea name="desc" id="desc" class="form-control ckeditor" placeholder="Enter Description" required>{{ $desc }}</textarea>
                                    <span class="text-danger">
                                        @error('desc')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Lead Time</label>
                                    <input type="text" class="form-control" name="lead_time" value="{{ $lead_time }}"
                                        placeholder="Enter Lead Time" required>
                                    <span class="text-danger">
                                        @error('lead_time')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Tax</label>
                                    <input type="text" class="form-control" name="tax" value="{{ $tax }}"
                                        placeholder="Enter Tax" required>
                                    <span class="text-danger">
                                        @error('tax')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Tax Type</label>
                                    <input type="text" class="form-control" name="tax_type" value="{{ $tax_type }}"
                                        placeholder="Enter Tax Type" required>
                                    <span class="text-danger">
                                        @error('tax_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label>Is Promo</label>
                                    <select name="is_promo" id="is_promo" class="form-control">
                                        @if ($is_promo == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('is_promo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label>Is Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        @if ($is_featured == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('is_featured')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label>Is Discounted</label>
                                    <select name="is_discounted" id="is_discounted" class="form-control">
                                        @if ($is_discounted == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('is_discounted')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label>Is Trending</label>
                                    <select name="is_trending" id="is_trending" class="form-control">
                                        @if ($is_trending == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('is_trending')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Warrenty</label>
                                    <input type="text" class="form-control" name="warrenty"
                                        value="{{ $warrenty }}" placeholder="Enter Warrenty" required>
                                    <span class="text-danger">
                                        @error('warrenty')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Image</label>
                                    @if ($image != '')
                                        <input type="file" class="form-control" name="image"
                                            value="{{ $image }}" placeholder="Enter image">
                                        <img src="{{ asset('/images/product/' . $image) }}" alt="product image"
                                            style="width: 150px" class="m-2">
                                    @else
                                        <input type="file" class="form-control" name="image"
                                            placeholder="Enter image" required>
                                    @endif
                                    <span class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Multiple Image</label>
                                    <input type="file" name="imageFile[]" class="form-control" multiple="multiple">
                                </div>
                            </div>
                            @if ($id > 0)
                                <button class="btn btn-success add_cat my-4">Update Product</button>
                            @else
                                <button class="btn btn-primary add_cat my-4">Add Product</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
