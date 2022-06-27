@extends('admin.include.layout');
@section('page_title', 'Banner Manage');
@push('custom_styles')
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
                        <h1 class="mb-0 fw-bold">Banner</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{url('admin/banner')}}" class="btn btn-outline-primary">View Banner</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-2">
                        <form method="post" class="add_form"  enctype="multipart/form-data" action="{{ route('banner.save') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$id}}">
                                <div class="col-md-6 my-3">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$title}}" placeholder="Enter Title" required>
                                    <span class="text-danger">@error('title')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Description</label>
                                    <textarea name="desc" id="desc" class="form-control" placeholder="Enter Description" required>{{ $desc }}</textarea>
                                    <span class="text-danger">@error('desc')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Button Text</label>
                                    <input type="text" class="form-control" name="btn_text" value="{{$btn_text}}" placeholder="Enter Button Text" required>
                                    <span class="text-danger">@error('btn_text')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Button Link</label>
                                    <input type="text" class="form-control" name="btn_link" value="{{$btn_link}}" placeholder="Enter btn_link" required>
                                    <span class="text-danger">@error('btn_link')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label>Image</label>
                                    @if ($image != '')
                                        <input type="file" class="form-control" name="image" value="{{$image}}" placeholder="Upload image">
                                        <img src="{{asset('/images/banner/'.$image)}}" alt="brand image" style="width: 150px" class="m-2">
                                    @else
                                        <input type="file" class="form-control" name="image" placeholder="Upload image" required>
                                    @endif
                                    <span class="text-danger">@error('image')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                            </div>
                            @if ($id > 0)
                                <button class="btn btn-success my-4">Update Banner</button>
                            @else
                                <button class="btn btn-primary my-4">Add Banner</button>
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
