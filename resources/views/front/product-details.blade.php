@extends('front.include.layout')
@section('page_title', 'Product Detail')
{{-- @push('custom_styles')
    <link href="{{ asset('assets/css/simulator/dashboard.css') }}" rel="stylesheet" />
@endpush --}}

@section('container')
    <div class="breadcrumb-area pt-95 pb-100 bg-img"
        style="background-image:url({{ asset('front_assets/assets/images/bg/breadcrumb.jpg') }});">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <div class="breadcrumb-title">
                    <h2>Product details</h2>
                </div>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="active">Product details </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-details-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-img">
                        @foreach ($productDetails as $item)
                            <div class="zoompro-border zoompro-span">
                                <img class="zoompro" src="{{ asset('images/product/' . $item->image) }}"
                                    data-zoom-image="{{ asset('images/product/' . $item->image) }}" alt="" />
                                <span>-29%</span>
                            </div>
                        @endforeach
                        <div id="gallery" class="mt-20 product-dec-slider">
                            @foreach ($pro_multiple_images as $item)
                                <?php foreach (json_decode($item[0]->multiple_images)as $picture) { ?>
                                <a data-image="{{ asset('images/product/multiple/' . $picture) }}"
                                    data-zoom-image="{{ asset('images/product/multiple/' . $picture) }}">
                                    <img src="{{ asset('images/product/multiple/' . $picture) }}" alt=""
                                        width="100px">
                                </a>
                                <?php } ?>
                            @endforeach
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content ml-30">
                        @foreach ($productDetails as $item)
                            <h2>{{ $item->name }}</h2>
                            <div class="product-details-price">
                                @foreach ($pro_attr[$item->id] as $attr)
                                    <span>${{ $attr->price }} </span>
                                    <span class="old">${{ $attr->mrp }} </span>
                                @endforeach
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="pro-details-rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </div>
                                <span><a href="#">3 Reviews</a></span>
                            </div>
                            <p>{{ $item->desc }}</p>
                            <div class="pro-details-list">
                                <ul>
                                    <li>- 0.5 mm Dail</li>
                                    <li>- Inspired vector icons</li>
                                    <li>- Very modern style </li>
                                </ul>
                            </div>
                            <div class="pro-details-size-color">
                                <div class="pro-details-color-wrap">
                                    <span>Color</span>
                                    <div class="pro-details-color-content">
                                        <ul>
                                            @foreach ($pro_attr[$item->id] as $attr)
                                                <li class="{{ $attr->color }}"></li>
                                            @endforeach
                                            {{-- @php
                                                $uniques = array(); 
                                                foreach ($pro_attr[$item->id] as $attr) {
                                                    $uniques[$attr->color] = $attr; 
                                                }
                                            @endphp  
                                             <li class="{{ $uniques[$attr->color]['color'] }}"></li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="pro-details-size">
                                    <span>Size</span>
                                    <div class="pro-details-size-content">
                                        <ul>
                                            @foreach ($pro_attr[$item->id] as $attr)
                                                {{-- {{ dd($attr)}} --}}
                                                <li><a href="#" class="size_btn"
                                                        product_id="{{ $attr->product_id }}"
                                                        pro_attr_id="{{ $attr->id }}">{{ $attr->size }}</a></li>
                                            @endforeach
                                            <input type="hidden" class="product_id" value="">
                                            <input type="hidden" class="pro_attr_id" value="">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                            </div>
                            <div class="pro-details-cart btn-hover">
                                <a href="javascript:void(0)" class="add_to_cart">Add To Cart</a>
                            </div>
                            <div class="pro-details-wishlist">
                                <a title="Add To Wishlist" href="#"><i class="la la-heart-o"></i></a>
                            </div>
                            <div class="pro-details-compare">
                                <a title="Add To Compare" href="#"><i class="la la-refresh"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-meta">
                            <span>Categories :</span>
                            <ul>
                                <li><a href="#">Minimal,</a></li>
                                <li><a href="#">Furniture,</a></li>
                                <li><a href="#">Fashion</a></li>
                            </ul>
                        </div>
                        <div class="pro-details-meta">
                            <span>Tag :</span>
                            <ul>
                                <li><a href="#">Fashion, </a></li>
                                <li><a href="#">Furniture,</a></li>
                                <li><a href="#">Electronic</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description-review-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="description-review-wrapper">
                        <div class="description-review-topbar nav">
                            <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                            <a data-bs-toggle="tab" href="#des-details3">Additional information</a>
                            <a data-bs-toggle="tab" href="#des-details2">Reviews (3)</a>
                        </div>
                        <div class="tab-content description-review-bottom">
                            <div id="des-details1" class="tab-pane active">
                                <div class="product-description-wrapper">
                                    <p>Pellentesque orci lectus, bibendum iaculis aliquet id, ullamcorper nec ipsum. In
                                        laoreet ligula vitae tristique viverra. Suspendisse augue nunc, laoreet in arcu ut,
                                        vulputate malesuada justo. Donec porttitor elit justo, sed lobortis nulla interdum
                                        et. Sed lobortis sapien ut augue condimentum, eget ullamcorper nibh lobortis. Cras
                                        ut bibendum libero. Quisque in nisl nisl. Mauris vestibulum leo nec pellentesque
                                        sollicitudin.</p>
                                    <p>Pellentesque lacus eros, venenatis in iaculis nec, luctus at eros. Phasellus id
                                        gravida magna. Maecenas fringilla auctor diam consectetur placerat. Suspendisse non
                                        convallis ligula. Aenean sagittis eu erat quis efficitur. Maecenas volutpat erat ac
                                        varius bibendum. Ut tincidunt, sem id tristique commodo, nunc diam suscipit lectus,
                                        vel</p>
                                </div>
                            </div>
                            <div id="des-details3" class="tab-pane">
                                <div class="product-anotherinfo-wrapper">
                                    <ul>
                                        <li><span>Weight</span> 400 g</li>
                                        <li><span>Dimensions</span>10 x 10 x 15 cm </li>
                                        <li><span>Materials</span> 60% cotton, 40% polyester</li>
                                        <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('front_assets/assets/images/product-details/client-1.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="review-content">
                                            <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo
                                                maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4>Stella McGee</h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('front_assets/assets/images/product-details/client-2.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="review-content">
                                            <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo
                                                maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4>Stella McGee</h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('front_assets/assets/images/product-details/client-3.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="review-content">
                                            <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo
                                                maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4>Stella McGee</h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ratting-form-wrapper">
                                    <span>Add a Review</span>
                                    <p>Your email address will not be published. Required fields are marked <span>*</span>
                                    </p>
                                    <div class="star-box-wrap">
                                        <div class="single-ratting-star">
                                            <i class="la la-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                            <i class="la la-star"></i>
                                        </div>
                                    </div>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Your review <span>*</span></label>
                                                        <textarea name="Your Review"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Name <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Email <span>*</span></label>
                                                        <input type="email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="pro-dec-banner">
                        <a href="#"><img src="{{ asset('front_assets/assets/images/banner/banner-4.png') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related products --}}
    <div class="product-area pb-100">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>Related products</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="product-slider-active owl-carousel">
                @foreach ($category as $cat)
                    @foreach ($related_product[$cat->id] as $pro)
                        <div class="product-wrap product-border-1">
                            <div class="product-img">
                                <a href="{{ url('product/' . $pro->slug) }}"><img
                                        src="{{ asset('front_assets/assets/images/product/hm1-pro-1.jpg') }}"
                                        alt="product"></a>
                                <div class="product-action">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                        href="#"><i class="la la-plus"></i></a>
                                    <a title="Add To Cart" href="#"><i class="la la-shopping-cart"></i></a>
                                    <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                                </div>
                            </div>
                            <div class="product-content product-content-padding text-center">
                                <h4><a href="{{ url('product/' . $pro->slug) }}">{{ $pro->name }}</a></h4>
                                <div class="product-rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </div>
                                <div class="product-price">
                                    <span>£210.00</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>

@endsection
@section('custom_script')
    <script>
        $(document).ready(function() {
            fetchCartData(468);
        });
        // Size btn
        $(document).on('click', '.size_btn', function(e) {
            e.preventDefault();
            $('.product_id').val($(this).attr("product_id"));
            $('.pro_attr_id').val($(this).attr("pro_attr_id"));
        });

        // Add To Cart
        $(document).on('click', '.add_to_cart', function(e) {
            e.preventDefault();
            var product_id = $('.product_id').val();
            var pro_attr_id = $('.pro_attr_id').val();
            var qty = $('.cart-plus-minus-box').val();
            // var user_id = Math.floor(Math.random() * (999 - 100 + 1)) + 100;
            var user_id = 468;
            var user_type = 0;

            if (product_id == '') {
                alert("Please Select Size");
            }
            fromData = {
                product_id: product_id,
                pro_attr_id: pro_attr_id,
                qty: qty,
                user_id: user_id,
                user_type: user_type,
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
                    if (res.status == 200) {
                        fetchCartData(user_id);
                    } else {
                        alert(res.message)
                    }
                }
            });
        });

        // Fetch Cart data 
        let fetchCartData = (user_id) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: `{{ url('fetch-cart-data') }}`,
                data: {
                    user_id: user_id,
                },
                dataType: "JSON",

                success: function(res) {
                    var cart = res.data.cart;

                    var len = 0;
                    $('#cart_show').empty();
                    if (cart != null) {
                        len = cart.length;
                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var tr_str = `
                            <li class="single-product-cart">
                                    <div class="cart-img">
                                        <a href="#"><img src="{{ asset('images/product/${cart[i].image}') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="cart-title">
                                        <h4><a href="#"> ${cart[i].name} </a></h4>
                                        <span>${cart[i].qty} × £${cart[i].price}.00</span>
                                    </div>
                                    <div class="cart-delete">
                                        <a href="#">×</a>
                                    </div>
                            </li>`;
                            $("#cart_show").append(tr_str);
                        }
                    } else {
                        var tr_str = `
                        <li class="single-product-cart">
                            <div class="cart-title">
                                <h4>Cart Empty</h4>
                            </div>
                        </li>
                        `;
                        $("#cart_show").append(tr_str);
                    }
                }
            });
        };
    </script>
@endsection
