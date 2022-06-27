@extends('front.include.layout')
@section('page_title', 'Cart')
@section('container')
    <div class="breadcrumb-area pt-95 pb-100 bg-img"
        style="background-image:url({{ asset('front_assets/assets/images/bg/breadcrumb.jpg') }});">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <div class="breadcrumb-title">
                    <h2>cart page</h2>
                </div>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">cart </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            @if (isset($cart[0]))
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Until Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img
                                                            src="{{ asset('images/product/' . $item->image) }}"
                                                            alt="" width="100px"></a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="#">{{ $item->name }}</a> <br>
                                                    <span>Size : {{ $item->size }} || Color : {{ $item->color }} </span>
                                                </td>
                                                <td class="product-price-cart"><span
                                                        class="amount">${{ $item->price }}</span>
                                                </td>
                                                <td>
                                                    <select class="form-control"
                                                        onchange="UpdateCart(this, '{{ $item->id }}')">
                                                        <?php
                                                        for ($x = 1; $x <= $item->attr_qty; $x++) {
                                                            if ($item->qty == $x) {
                                                                echo "<option value='$item->qty' selected>$item->qty</option>";
                                                            } else {
                                                                echo "<option value='$x'>$x</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td class="product-subtotal"> {{ $item->price * $item->qty }}</td>
                                                <td class="product-remove">
                                                    <a href="javascript:void(0)" class="remove_cart"
                                                        value="{{ $item->id }}"><i class="la la-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                 </tbody>
                            </table>
                            @else
                                <h4 class="text-center">Cart Empty</h4>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="#">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                </div>
                                <div class="tax-wrapper">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                * Country
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * Region / State
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * Zip/Postal Code
                                            </label>
                                            <input type="text">
                                        </div>
                                        <button class="cart-btn-2" type="submit">Get A Quote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input type="text" required="" name="name">
                                        <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total products <span>$260.00</span></h5>
                                <div class="total-shipping">
                                    <h5>Total shipping</h5>
                                    <ul>
                                        <li><input type="checkbox"> Standard <span>$20.00</span></li>
                                        <li><input type="checkbox"> Express <span>$30.00</span></li>
                                    </ul>
                                </div>
                                <h4 class="grand-totall-title">Grand Total <span>$260.00</span></h4>
                                <a href="#">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function UpdateCart(select, cart_id) {
            var qty = select.options[select.selectedIndex];
            fromData = {
                cart_id: cart_id,
                qty: qty.value,
                key: 'update',
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: `{{ url('add-to-cart') }}`,
                data: fromData,
                dataType: "JSON",
                success: function(res) {
                    console.log(res);
                    location.reload();
                }
            });
        }

        // Rempve Cart Item
        $(document).on('click', '.remove_cart', function(e) {
            e.preventDefault();
            var id = $(this).attr("value");
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
                            url: `{{ url('cart-remove/${id}') }}`,
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
                        swal("Cart not removed!");
                    }
                });
        });
        // });
    </script>
@endsection
