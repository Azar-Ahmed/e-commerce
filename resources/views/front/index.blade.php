@extends('front.include.layout')
@section('page_title', 'Home')
{{-- @push('custom_styles')
    <link href="{{ asset('{{asset('front_assets/assets/css/simulator/dashboard.css') }}" rel="stylesheet" />
@endpush --}}
@section('container')

@include('front/include/slider')

    <!-- banner -->
    <div class="banner-area pt-20 pb-70 padding-10-row-col">
        <div class="container-fluid">
            <div class="row">
                @if (isset($banner[0]))
                @foreach ($banner as $item)
                    <div class="col-lg-4 col-md-4">
                        <div class="banner-wrap mb-30">
                            <a href="{{$item->btn_link}}" target="_blank"><img class="animated"
                                    src="{{ asset('images/banner/'.$item->image) }}" alt=""></a>
                            <div class="banner-content banner-position-1">
                                <h3>{{$item->title}}</h3>
                                <div class="banner-btn">
                                    <a href="{{$item->btn_link}}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="col-12">
                    <div class="product-wrap product-border-1 mb-30">
                        <h3 class="text-danger text-center">No Banner Found</h3>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
    <!-- products -->
    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>All Products</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="product-tab-list nav pb-50 text-center">
                <a href="#latest" data-bs-toggle="tab">
                    <h4>New Arrivals </h4>
                </a>
                <a class="active" href="#trending" data-bs-toggle="tab">
                    <h4>Trending</h4>
                </a>
                <a href="#featured" data-bs-toggle="tab">
                    <h4>Featured</h4>
                </a>
                <a href="#discounted" data-bs-toggle="tab">
                    <h4>Discounted</h4>
                </a>
            </div>
            <div class="tab-content jump">
                <div id="latest" class="tab-pane">
                    <div class="row">
                        @if (isset($lastest_products[0]))
                            @foreach ($lastest_products as $pro)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-1 mb-30">
                                        <div class="product-img">
                                            <a href="{{url('product/'.$pro->slug)}}"><img
                                                    src="{{ asset('images/product/'.$pro->image) }}" alt="product"></a>
                                            <span class="product-badge">-30%</span>
                                            <div class="product-action">
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                                    href="#"><i class="la la-plus"></i></a>
                                                <a title="Add To Cart" href="#"><i
                                                        class="la la-shopping-cart"></i></a>
                                                <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding text-center">
                                            <h4><a href="{{url('product/'.$pro->slug)}}">{{ $pro->name }}</a></h4>
                                            <div class="product-rating">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                            <div class="product-price">
                                                <span>£210.00</span>
                                                <span class="old">£230.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="product-wrap product-border-1 mb-30">
                                    <h3 class="text-danger text-center">No Product Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="trending" class="tab-pane active">
                    <div class="row">
                        @if (isset($trending_products[0]))
                            @foreach ($trending_products as $trending_pro)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-1 mb-30">
                                        <div class="product-img">
                                            <a href="{{url('product/'.$trending_pro->slug)}}"><img
                                                    src="{{ asset('images/product/' . $trending_pro->image) }}"
                                                    alt="product"></a>
                                            <span class="product-badge">-30%</span>
                                            <div class="product-action">
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                                    href="#"><i class="la la-plus"></i></a>
                                                <a title="Add To Cart" href="#"><i
                                                        class="la la-shopping-cart"></i></a>
                                                <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding text-center">
                                            <h4><a href="{{url('product/'.$trending_pro->slug)}}">{{ $trending_pro->name }}</a></h4>
                                            <div class="product-rating">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                            <div class="product-price">
                                                <span>£210.00</span>
                                                <span class="old">£230.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="product-wrap product-border-1 mb-30">
                                    <h3 class="text-danger text-center">No Product Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="featured" class="tab-pane">
                    <div class="row">
                        @if (isset($featured_products[0]))
                            @foreach ($featured_products as $featured_pro)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-1 mb-30">
                                        <div class="product-img">
                                            <a href="{{url('product/'.$featured_pro->slug)}}"><img
                                                    src="{{ asset('images/product/' . $featured_pro->image) }}"
                                                    alt="product"></a>
                                            <span class="product-badge">-30%</span>
                                            <div class="product-action">
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                <a title="Add To Cart" href="#"><i
                                                        class="la la-shopping-cart"></i></a>
                                                <a title="Wishlist" href="wishlist.html"><i
                                                        class="la la-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding text-center">
                                            <h4><a href="{{url('product/'.$featured_pro->slug)}}">{{ $featured_pro->name }}</a></h4>
                                            <div class="product-rating">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                            </div>
                                            <div class="product-price">
                                                <span>£210.00</span>
                                                <span class="old">£230.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="product-wrap product-border-1 mb-30">
                                    <h3 class="text-danger text-center">No Product Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="discounted" class="tab-pane">
                    <div class="row">
                        @if (isset($discount_products[0]))
                            @foreach ($discount_products as $discount_pro)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-1 mb-30">
                                        <div class="product-img">
                                            <a href="{{url('product/'.$discount_pro->slug)}}"><img
                                                    src="{{ asset('images/product/' . $discount_pro->image) }}"
                                                    alt="product"></a>
                                            <div class="product-action">
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                <a title="Add To Cart" href="#"><i
                                                        class="la la-shopping-cart"></i></a>
                                                <a title="Wishlist" href="wishlist.html"><i
                                                        class="la la-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding text-center">
                                            <h4><a href={{url('product/'.$discount_pro->slug)}}">{{ $discount_pro->name }}</a></h4>
                                            <div class="product-rating">
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star"></i>
                                                <i class="la la-star-half-o"></i>
                                            </div>
                                            <div class="product-price">
                                                <span>£210.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="product-wrap product-border-1 mb-30">
                                    <h3 class="text-danger text-center">No Product Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- deal -->
    <div class="deal-area pt-100 pb-100 bg-img"
        style="background-image:url({{ asset('front_assets/assets/images/bg/bg-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="deal-content text-center">
                        <h3>Sale 30%</h3>
                        <h2>Big Weekend Sale</h2>
                        <div class="timer">
                            <div data-countdown="2022/01/01"></div>
                        </div>
                        <div class="deal-btn default-btn btn-hover">
                            <a class="btn-size-xs btn-bg-theme btn-color black-color" href="#">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Sells -->
    <div class="product-area pt-100 pb-100">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>Best Sell</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="product-slider-active owl-carousel">
                <div class="product-wrap product-border-1">
                    <div class="product-img">
                        <a href="product-details.html"><img
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
                        <h4><a href="product-details.html">Demo Product Name</a></h4>
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
                <div class="product-wrap product-border-1">
                    <div class="product-img">
                        <a href="product-details.html"><img
                                src="{{ asset('front_assets/assets/images/product/hm1-pro-2.jpg') }}"
                                alt="product"></a>
                        <span class="product-badge">Sell</span>
                        <div class="product-action">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                href="#"><i class="la la-plus"></i></a>
                            <a title="Add To Cart" href="#"><i class="la la-shopping-cart"></i></a>
                            <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                        </div>
                    </div>
                    <div class="product-content product-content-padding text-center">
                        <h4><a href="product-details.html">Demo Product Name</a></h4>
                        <div class="product-rating">
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                        </div>
                        <div class="product-price">
                            <span>£150.00</span>
                            <span class="old">£180.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap product-border-1">
                    <div class="product-img">
                        <a href="product-details.html"><img
                                src="{{ asset('front_assets/assets/images/product/hm1-pro-3.jpg') }}"
                                alt="product"></a>
                        <div class="product-action">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                href="#"><i class="la la-plus"></i></a>
                            <a title="Add To Cart" href="#"><i class="la la-shopping-cart"></i></a>
                            <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                        </div>
                    </div>
                    <div class="product-content product-content-padding text-center">
                        <h4><a href="product-details.html">Demo Product Name</a></h4>
                        <div class="product-rating">
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                        </div>
                        <div class="product-price">
                            <span>£250.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap product-border-1">
                    <div class="product-img">
                        <a href="product-details.html"><img
                                src="{{ asset('front_assets/assets/images/product/hm1-pro-4.jpg') }}"
                                alt="product"></a>
                        <span class="product-badge">Sell</span>
                        <div class="product-action">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                href="#"><i class="la la-plus"></i></a>
                            <a title="Add To Cart" href="#"><i class="la la-shopping-cart"></i></a>
                            <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                        </div>
                    </div>
                    <div class="product-content product-content-padding text-center">
                        <h4><a href="product-details.html">Demo Product Name</a></h4>
                        <div class="product-rating">
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                        </div>
                        <div class="product-price">
                            <span>£270.00</span>
                            <span class="old">£290.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap product-border-1">
                    <div class="product-img">
                        <a href="product-details.html"><img
                                src="{{ asset('front_assets/assets/images/product/hm1-pro-5.jpg') }}"
                                alt="product"></a>
                        <div class="product-action">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" title="Quick View"
                                href="#"><i class="la la-plus"></i></a>
                            <a title="Add To Cart" href="#"><i class="la la-shopping-cart"></i></a>
                            <a title="Wishlist" href="wishlist.html"><i class="la la-heart-o"></i></a>
                        </div>
                    </div>
                    <div class="product-content product-content-padding text-center">
                        <h4><a href="product-details.html">Demo Product Name</a></h4>
                        <div class="product-rating">
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                        </div>
                        <div class="product-price">
                            <span>£230.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feedback -->
    <div class="testimonial-area bg-gray pb-100 pt-95">
        <div class="container">
            <div class="testimonial-active owl-carousel">
                <div class="single-testimonial text-center">
                    <img src="{{ asset('front_assets/assets/images/testimonial/testi-1.png') }}" alt="">
                    <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et
                        dolore magna aliqua ex commo consequat irure "</p>
                    <span>Tayeb Rayed</span>
                </div>
                <div class="single-testimonial text-center">
                    <img src="{{ asset('front_assets/assets/images/testimonial/testi-2.png') }}" alt="">
                    <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et
                        dolore magna aliqua ex commo consequat irure "</p>
                    <span>Arham Rafan</span>
                </div>
            </div>
        </div>
    </div>
    <!-- blog -->
    <div class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center mb-45">
                <h2>Latest Blog</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap mb-30">
                        <div class="blog-img mb-15">
                            <a href="blog-details.html"><img alt=""
                                    src="{{ asset('front_assets/assets/images/blog/blog-1.jpg') }}"></a>
                        </div>
                        <div class="blog-content text-center">
                            <div class="blog-category">
                                <a href="#">Fashion</a>
                            </div>
                            <h3><a href="blog-details.html">We Denounce with Righteou</a></h3>
                            <div class="blog-meta">
                                <a href="#"><i class="la la-user"></i> Madhubi</a>
                                <a href="#"><i class="la la-clock-o"></i> May 29, 2019</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap mb-30">
                        <div class="blog-img mb-15">
                            <a href="blog-details.html"><img alt=""
                                    src="{{ asset('front_assets/assets/images/blog/blog-2.jpg') }}"></a>
                        </div>
                        <div class="blog-content text-center">
                            <div class="blog-category">
                                <a href="#">Furniture</a>
                            </div>
                            <h3><a href="blog-details.html">It is a long established fact</a></h3>
                            <div class="blog-meta">
                                <a href="#"><i class="la la-user"></i> Farhana</a>
                                <a href="#"><i class="la la-clock-o"></i> May 29, 2019</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap mb-30">
                        <div class="blog-img mb-15">
                            <a href="blog-details.html"><img alt=""
                                    src="{{ asset('front_assets/assets/images/blog/blog-3.jpg') }}"></a>
                        </div>
                        <div class="blog-content text-center">
                            <div class="blog-category">
                                <a href="#">Lamp</a>
                            </div>
                            <h3><a href="blog-details.html">We Denounce with Righteou</a></h3>
                            <div class="blog-meta">
                                <a href="#"><i class="la la-user"></i> Rayed</a>
                                <a href="#"><i class="la la-clock-o"></i> May 29, 2019</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- instagram -->
    <div class="instagram-feed-thumb pb-100">
        <div id="instafeed" class="instafeed-style"></div>
    </div>
    <!-- brand -->

    <div class="brand-logo-area pb-100">
        <div class="container">
            <div class="brand-logo-active owl-carousel">
                @foreach ($brand as $brands)
                    <div class="single-brand-logo">
                        <img src="{{ asset('images/brand/' . $brands->image) }}" alt="{{ $brands->brand }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
{{-- <script>
    function SearchFun(){
        var input = $('.search_input').val()
        if(input !=''){
            window.location.href='{{url('search/input')}}'
        }
    }
</script> --}}
@endsection