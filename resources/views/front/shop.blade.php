@extends('front.include.layout')
@section('page_title', 'Shop')

@section('container')
    <div class="breadcrumb-area pt-95 pb-100 bg-img"
        style="background-image:url({{ asset('front_assets/assets/images/bg/breadcrumb.jpg') }});">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <div class="breadcrumb-title">
                    @foreach ($cat as $item)
                        <h2>{{ $item->cat_name }} page</h2>
                    @endforeach
                </div>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    @foreach ($cat as $item)
                        <li class="active">{{ $item->cat_name }} page </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-top-bar">
                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <select onchange="sort_by(this)" id="sort_by">
                                    <option value="latest">Sort by newness</option>
                                    <option value="name_asc">A-Z</option>
                                    <option value="name_desc">Z-A</option>
                                    <option value="price_desc">Price - Desc</option>
                                    <option value="price_asc"> Price -Asc</option>
                                    <option value="in_stock">In stock</option>
                                </select>
                            </div>
                            <p>Showing 1–12 of 20 result</p>
                        </div>
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-1" data-bs-toggle="tab">
                                <i class="la la-th-large"></i>
                            </a>
                            <a href="#shop-2" data-bs-toggle="tab">
                                <i class="la la-reorder"></i>
                            </a>
                        </div>
                    </div>
                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">
                                    @foreach ($cat_products as $item)
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                            <div class="product-wrap product-border-1 mb-30">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $item->slug) }}"><img
                                                            src="{{ asset('images/product/' . $item->image) }}"
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
                                                    <h4><a
                                                            href="{{ url('product/' . $item->slug) }}">{{ $item->name }}</a>
                                                    </h4>
                                                    <div class="product-rating">
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>£{{ $item->price }}</span>
                                                        <span class="old">£{{ $item->mrp }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="shop-2" class="tab-pane">
                                @foreach ($cat_products as $item)
                                    <div class="shop-list-wrap mb-30">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                                <div class="product-wrap product-border-1">
                                                    <div class="product-img">
                                                        <a href="{{ url('product/' . $item->slug) }}">
                                                            <img src="{{ asset('images/product/' . $item->image) }}"
                                                                alt="product">
                                                        </a>
                                                        <span class="product-badge">-30%</span>
                                                        <div class="product-action">
                                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                title="Quick View" href="#"><i
                                                                    class="la la-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-7 col-md-7 col-sm-6">
                                                <div class="shop-list-content">
                                                    <h3><a
                                                            href="{{ url('product/' . $item->slug) }}">{{ $item->name }}</a>
                                                    </h3>
                                                    <div class="product-list-rating">
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                    </div>
                                                    <div class="product-list-price">
                                                        <span>$ {{ $item->price }}</span>
                                                        <span class="old">$ {{ $item->mrp }}</span>
                                                    </div>
                                                    <p>{{ $item->desc }}</p>
                                                    <div class="shop-list-btn-wrap">
                                                        <div class="shop-list-cart default-btn btn-hover">
                                                            <a href="#">ADD TO CART</a>
                                                        </div>
                                                        <div class="shop-list-wishlist default-btn btn-hover">
                                                            <a href="#"><i class="la la-heart-o"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pro-pagination-style text-center mt-20">
                            <ul>
                                <li><a class="prev" href="#"><i class="la la-angle-left"></i></a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a class="next" href="#"><i class="la la-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar-style mr-30">
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">Search </h4>
                            <div class="pro-sidebar-search mb-50 mt-25">
                                <form class="pro-sidebar-search-form" action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button>
                                        <i class="la la-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">Refine By </h4>
                            <div class="sidebar-widget-list mt-30">
                                <ul>
                                    @foreach ($category as $item)
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox"> <a href="{{ url('shop/' . $item->cat_slug) }}" checked>{{ $item->cat_name }}
                                                    <span>4</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mt-45">
                            <h4 class="pro-sidebar-title">Filter By Price </h4>
                            <div class="price-filter mt-10">
                                <div class="price-slider-amount">
                                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                </div>
                                <div id="slider-range"></div>
                            </div>
                        </div>
                        <div class="sidebar-widget mt-40">
                            <h4 class="pro-sidebar-title">Color </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    @foreach ($color as $item)
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value="" onclick="ColorFilter('{{ $item->color }}')"> <a
                                                    href="javascript:void(0)">{{ $item->color }} <span>4</span>
                                                </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mt-40">
                            <h4 class="pro-sidebar-title">Size </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    @foreach ($size as $item)
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a
                                                    href="#">{{ $item->size }} <span>4</span>
                                                </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mt-50">
                            <h4 class="pro-sidebar-title">Tag </h4>
                            <div class="sidebar-widget-tag mt-25">
                                <ul>
                                    @foreach ($category as $item)
                                        <li><a href="#">{{ $item->cat_name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="catFilter">
        <input type="hidden" name="sort_by" class="sort_by">
        <input type="hidden" name="color_filter" class="color_filter">
    </form>
@endsection

@section('custom_script')
    <script>
        function sort_by(select) {
            var sort = select.options[select.selectedIndex];
            $('.sort_by').val(sort.value)
            $('#catFilter').submit();
        }

        function ColorFilter(color){
            $('.color_filter').val(color)
            $('#catFilter').submit();
        }
    </script>
@endsection
