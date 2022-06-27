@extends('admin.include.layout');
@section('page_title', 'Product');

@push('custom_styles')
    {{-- <link href="{{ asset('assets/css/simulator/dashboard.css') }}" rel="stylesheet" /> --}}
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
                        <h1 class="mb-0 fw-bold">Product</h1>
                    </div>
                    <div class="p-2 bd-highlight">
                        <?php $id = 'add'; ?>
                        <a href="{{ url('admin/product-form/' . $id) }}" class="btn btn-outline-primary">Add Product</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($data as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->cat_name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->image != '')
                                                    <img src="{{ asset('/images/product/' . $item->image) }}" alt=""
                                                        style="width: 100px">
                                                @else
                                                    <img src="{{ asset('/images/default_img/cat.jpg') }}" alt="image"
                                                        style="width: 100px">
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-dark add_product_attributes_btn"
                                                    data-bs-toggle="modal" data-bs-target="#attributesModal"
                                                    value="{{ $item->id }}">
                                                    Add Attributes
                                                </button>
                                                {{-- View --}}
                                                <button type="button" class="btn btn-outline-info view_product"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    value="{{ $item->id }}">
                                                    View
                                                </button>
                                                {{-- Status --}}
                                                @if ($item->status == 1)
                                                    <a href="{{ url('product-status/deactive/' . $item->slug) }}"
                                                        class="btn btn-outline-success">Active</a>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ url('product-status/active/' . $item->slug) }}"
                                                        class="btn btn-outline-danger">Deactive</a>
                                                @endif
                                                {{-- Edit --}}
                                                <a href="{{ url('admin/product-form/' . $item->id) }}"
                                                    class="btn btn-outline-primary">Edit</a>
                                                {{-- Delete --}}
                                                <button type="button" value="{{ $item->id }}"
                                                    class="delete_product m-1 btn btn-outline-danger">Delete</button>
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

    <!-- Product Detail Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Product Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="productDetails"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Att Modal --}}
    <div class="modal fade" id="attributesModal" tabindex="-1" aria-labelledby="attributesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="attributesModalLabel">Product Attributes</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" class="form" id="frm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="product_id" class="product_id" value=""> 
                             <div class="col-md-4 my-3">
                                    <label>Sku</label>
                                    <input type="text" class="form-control sku" name="sku" placeholder="Enter Sku" required>
                                    <span class="text-danger">
                                        @error('sku')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Mrp</label>
                                    <input type="text" class="form-control mrp" name="mrp" placeholder="Enter Mrp" required>
                                    <span class="text-danger">
                                        @error('mrp')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Price</label>
                                    <input type="text" class="form-control price" name="price" placeholder="Enter Price" required>
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Qty</label>
                                    <input type="text" class="form-control qty" name="qty" placeholder="Enter Qty" required>
                                    <span class="text-danger">
                                        @error('qty')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-4 my-3">
                                    <label>Size</label>
                                    <select name="size" class="form-control size">
                                        <option value="">Select Size</option>
                                        @foreach ($size as $item)
                                                <option value="{{ $item->size }}">{{ $item->size }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('size')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>  
                                <div class="col-md-4 my-3">
                                    <label>Color</label>
                                    <select name="color" class="form-control color">
                                        <option value="">Select Color</option>
                                        @foreach ($color as $item)
                                                <option value="{{ $item->color }}">{{ $item->color }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('color')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> 
                                <div class="col-md-6 my-3">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image"
                                            placeholder="Select image" required>
                                    <span class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-12 my-3">
                                    <button type="button" class="Add_Product_Atrr btn btn-dark">Add Attributes</button>
                                </div> 
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sku</th>
                                        <th scope="col">Mrp</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody1">
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
            // Delete Product
            $(document).on('click', '.delete_product', function(e) {
                e.preventDefault();
                var product_id = $(this).val();
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
                                url: `{{ url('product-delete/${product_id}') }}`,
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

            // View Product Details 
            $(document).on('click', '.view_product', function(e) {
                e.preventDefault();
                var product_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: `{{ url('product-view/${product_id}') }}`,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response.data);
                        if(response.data.product.is_promo > 0){
                            var is_promo = "Yes"
                        }else{
                            var is_promo = "No"
                        }

                        if(response.data.product.is_featured > 0){
                            var is_featured = "Yes"
                        }else{
                            var is_featured = "No"
                        }

                        if(response.data.product.is_discounted > 0){
                            var is_discounted = "Yes"
                        }else{
                            var is_discounted = "No"
                        }

                        if(response.data.product.is_trending > 0){
                            var is_trending = "Yes"
                        }else{
                            var is_trending = "No"
                        }
 
                        $('.productDetails').html(`
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('/images/product/${response.data.product.image}') }}" alt="" style="width:300px">
                            </div>

                            <div class="col-md-6">
                                <h3>${response.data.product.name} <small class="text-muted fs-6">${response.data.category[0].cat_name}</small></h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Price : <b class="text-primary fs-4">$30</b> <small class="text-muted text-decoration-line-through">28</small></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Brand : <b>${response.data.product.brand}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Features : <b>${response.data.product.features}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Keyword : <b>${response.data.product.keyword}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Warrenty : <b>${response.data.product.warrenty}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Lead Time : <b>${response.data.product.lead_time}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Tax : <b>${response.data.product.tax}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Tax Type : <b>${response.data.product.tax_type}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Is Promo : <b>${is_promo}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Is Featured : <b>${is_featured}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Is Discounted : <b>${is_discounted}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Is Trending : <b>${is_trending}</b></p>
                                    </div>
                                    <hr class="m-0"/>
                                    <div class="col-md-12">
                                        <p><b>${response.data.product.desc}</b></p>
                                    </div>
                                </div>
                            </div>
                         </div>
                        `);
                    }
                });

            });

            // Add product attr button 
            $(document).on('click', '.add_product_attributes_btn', function(e) {
                $('.product_id').val($(this).val())
                var pro_id = $(this).val()
                fetchAttr(pro_id);
            });

            // Add product attributes
            $(document).on('click', '.Add_Product_Atrr', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    var form = $('.form')[0]; // You need to use standard javascript object here
                    var formData = new FormData(form);
                   
               
                $.ajax({
                    type: "post",
                    url: `{{ url('product-attr-save') }}`,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(response) {
                        $("#frm").trigger("reset");
                        var attr = response.data
                        fetchAttr(attr);
                     }
                });

            });

            // Fetch Attrbutes data 
            let fetchAttr =  (p_id) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: `{{ url('product-attr-fetch') }}`,
                    data: {
                        product_id: p_id,
                    },
                    dataType: "JSON",

                    success: function(response) {
                        var attr = response.Data.productAttr

                        var len = 0;
                        $('#tbody1').empty(); 
                        if(attr != null){
                            len = attr.length;
                        }

                        if(len > 0){
                            for(var i=0; i<len; i++){
                              
                                var tr_str = `<tr>
                                    <td align='center'> ${attr[i].id} </td>
                                    <td align='center'> ${attr[i].sku} </td>
                                    <td align='center'> ${attr[i].mrp} </td>
                                    <td align='center'> ${attr[i].price} </td>
                                    <td align='center'> ${attr[i].qty} </td>
                                    <td align='center'> ${attr[i].size} </td>
                                    <td align='center'> ${attr[i].color} </td>
                                    <td><img src="{{ asset('images/product/${attr[i].image}') }}" style='width: 100px'></td>
                                    <td> <button type="button" class="m-1 btn btn-outline-danger">Delete</button></td>
                                </tr>`;

                                $("#tbody1").append(tr_str);
                            }
                        }else{
                            var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                            $("#tbody1").append(tr_str);
                        }
                     }
                });
            };
        });
    </script>
@endsection
