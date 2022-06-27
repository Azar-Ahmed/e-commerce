@extends('admin.include.layout');
@section('page_title', 'Coupon');

{{-- @push('custom_styles')
    <link href="{{ asset('assets/css/simulator/dashboard.css') }}" rel="stylesheet" />
@endpush --}}
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-grow-1 bd-highlight">
                        <h1 class="mb-0 fw-bold">User</h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;?>
                                    @foreach ($data as $item)
                                    <?php $i++;?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->last_name }}</td>
                                            <td>@if ($item->avatar!='')
                                                <img src="{{asset('/images/user/'.$item->avatar)}}" alt="" style="width: 100px">
                                                @endif</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <a href="{{ url('user-status/deactive/' . $item->id) }}"
                                                        class="btn btn-outline-success">Active</a>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ url('user-status/active/' . $item->id) }}"
                                                        class="btn btn-outline-danger">Deactive</a>
                                                @endif
                                            </td>
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
            $(document).on('click', '.delete_coupon', function(e) {
                e.preventDefault();
                var coupon_id = $(this).val();
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
                                url: `{{ url('coupon-delete/${coupon_id}') }}`,
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
