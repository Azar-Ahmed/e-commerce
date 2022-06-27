@extends('admin.include.layout');
@section('page_title', 'Size Manage');
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
                        <h1 class="mb-0 fw-bold">Size</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{url('admin/size')}}" class="btn btn-outline-primary">View Size</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-2">
                        <form method="post" class="add_form"  action="{{ route('size.save') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$id}}">
                                <div class="col-md-6 my-3">
                                    <label>Enter size</label>
                                    <input type="text" class="form-control" name="size" value="{{$size}}" placeholder="Enter size Name" required>
                                    <span class="text-danger">@error('size')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                            </div>
                            @if ($id > 0)
                                <button class="btn btn-success my-4">Update Size</button>
                            @else
                                <button class="btn btn-primary my-4">Add Size</button>
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
