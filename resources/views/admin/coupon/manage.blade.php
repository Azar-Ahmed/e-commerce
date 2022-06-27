@extends('admin.include.layout');
@section('page_title', 'Coupon Manage');
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
                        <h1 class="mb-0 fw-bold">Coupon</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="{{url('admin/coupon')}}" class="btn btn-outline-primary">View Coupon</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-2">
                        <form method="post" class="add_form" action="{{ route('coupon.save') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$id}}">
                                <div class="col-md-4 mt-4">
                                    <label>Title</label>
                                    <input type="text" class="form-control title" name="title" value="{{$title}}" placeholder="Enter Coupon Title" required>
                                    <span class="text-danger">@error('title')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label>Code</label>
                                    <input type="text" class="form-control code" name="code" value="{{$code}}" placeholder="Enter Coupon Code" required>
                                    <span class="text-danger">@error('code')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label>One Time Validity</label>
                                    <select name="uses_time" id="uses_time" class="form-control">
                                            @if ($uses_time == 1)
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            @endif
                                    </select>
                                    <span class="text-danger">@error('uses_time')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label>Value</label>
                                    <input type="text" class="form-control value" name="value" value="{{$value}}" placeholder="Enter Coupon Value" required>
                                    <span class="text-danger">@error('value')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label>Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Type</option>
                                            @if ($type == 'Value')
                                                <option value="Value" selected>Value</option>
                                                <option value="Percentage">Percentage</option>
                                            @elseif($type == 'Percentage')
                                            <option value="Value">Value</option>
                                            <option value="Percentage" selected>Percentage</option>
                                            @else
                                            <option value="Value">Value</option>
                                            <option value="Percentage">Percentage</option>
                                            @endif
                                    </select>
                                      <span class="text-danger">@error('type')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label>Min Order Amt</label>
                                    <input type="text" class="form-control min_order_amt" name="min_order_amt" value="{{$min_order_amt}}" placeholder="Enter Coupon Min Order Amt" required>
                                    <span class="text-danger">@error('min_order_amt')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                                
                                <div class="col-md-12 mt-4">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Enter Coupon Description" required>{{$description}}</textarea>
                                    <span class="text-danger">@error('description')
                                        {{$message}} 
                                    @enderror</span>
                                </div>
                            </div>
                            @if ($id > 0)
                                <button class="btn btn-success add_cat my-4">Update Coupon</button>
                            @else
                                <button class="btn btn-primary add_cat my-4">Add Coupon</button>
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
