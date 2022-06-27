@extends('admin.include.layout');
@section('page_title', 'Brand');

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
            <div class="col-12">
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-grow-1 bd-highlight">
                        <h1 class="mb-0 fw-bold">Brand</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <?php $id = 'add'; ?>
                        <a href="{{url('admin/brand-form/'.$id)}}" class="btn btn-outline-primary">Add Brand</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0;?>
                                    @foreach ($data as $item)
                                    <?php $i++;?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->brand }}</td>
                                            <td>
                                                @if ($item->image!='')
                                                <img src="{{asset('/images/brand/'.$item->image)}}" alt="" style="width: 100px">
                                                @else
                                                <img src="{{asset('/images/default_img/cat.jpg')}}" alt="image" style="width: 100px">
                                                @endif
                                                </td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <a href="{{ url('brand-status/deactive/' . $item->id) }}"
                                                        class="btn btn-outline-success">Active</a>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ url('brand-status/active/' . $item->id) }}"
                                                        class="btn btn-outline-danger">Deactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/brand-form/'.$item->id) }}" class="btn btn-outline-primary">Edit</a>
                                            </td>
                                            <td> <button type="button" value="{{ $item->id }}"
                                                    class="delete_brand m-1 btn btn-outline-danger">Delete</button></td>
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

@endsection
@section('custom_script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('success_msg') > 0)
        <script>
            swal({
                title: `{{ session('success_msg') }}`,
                icon: "success",
            });
        </script>
    @elseif (session('error_msg') > 0)
        <script>
            swal({
                title: `{{ session('error_msg') }}`,
                icon: "warning",
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
        
            // Delete Category
            $(document).on('click', '.delete_brand', function(e) {
                e.preventDefault();
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                swal({
                        title: "Are you sure?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "get",
                                url: `{{ url('brand-delete/${id}') }}`,
                                dataType: "JSON",
                                success: function(response) {
                                    swal(`${response.message}`, {
                                            icon: "success",
                                        })
                                        .then((value) => {
                                            location.reload();
                                        });
                                }
                            });
                        } else {
                            swal("Data Not Deleted!");
                        }
                    });
            });
        });
    </script>
@endsection
