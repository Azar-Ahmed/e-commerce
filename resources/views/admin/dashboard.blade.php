@extends('admin.include.layout');
@section('page_title', 'Dashboard');

{{-- @section('dashboard_select', 'active'); --}}
{{-- @yied('dashboard_select') --}}


{{-- @push('custom_styles')
    <link href="{{ asset('assets/css/simulator/dashboard.css') }}" rel="stylesheet" />
@endpush --}}
@section('container')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="index.html" class="link"><i
                                    class="mdi mdi-home-outline fs-4"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                {{-- <h1 class="mb-0 fw-bold">Dashboard</h1> --}}
                @foreach ($admin as $item)
                <h2 class="my-3 fw-bold">Welcome to Dashboard <b class="text-primary"> {{$item->first_name.''.$item->last_name}}</b></h2> 
               @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection