@extends('admin.include.layout');
@section('page_title', 'Banner');

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-grow-1 bd-highlight">
                        <h1 class="mb-0 fw-bold">Banner</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <?php $id = 'add'; ?>
                        <a href="{{url('admin/banner-form/'.$id)}}" class="btn btn-outline-primary">Add Banner</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Button Text</th>
                                        <th scope="col">Button Link</th>
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
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->desc }}</td>
                                            <td>{{ $item->btn_text }}</td>
                                            <td>{{ $item->btn_link }}</td>
                                            <td>
                                                @if ($item->image!='')
                                                <img src="{{asset('/images/banner/'.$item->image)}}" alt="" style="width: 100px">
                                                @else
                                                <img src="{{asset('/images/default_img/cat.jpg')}}" alt="image" style="width: 100px">
                                                @endif
                                                </td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <a href="{{ url('banner-status/deactive/' . $item->id) }}"
                                                        class="btn btn-outline-success">Active</a>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ url('banner-status/active/' . $item->id) }}"
                                                        class="btn btn-outline-danger">Deactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/banner-form/'.$item->id) }}" class="btn btn-outline-primary">Edit</a>
                                            </td>
                                            <td> <button type="button" value="{{ $item->id }}"
                                                    class="delete_banner m-1 btn btn-outline-danger">Delete</button></td>
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
            $(document).on('click', '.delete_banner', function(e) {
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
                                url: `{{ url('banner-delete/${id}') }}`,
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
