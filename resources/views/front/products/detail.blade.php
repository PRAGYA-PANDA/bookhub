{{-- Note: front/products/detail.blade.php is the page that opens when you click on a product in the FRONT home page --}} {{-- $productDetails, categoryDetails and $totalStock are passed in from detail() method in Front/ProductsController.php --}}
@extends('front.layout.layout2')


@section('content')
    {{-- Star Rating (of a Product) (in the "Reviews" tab) --}}
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            /* position:absolute; */
            position: inherit;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .breadcrumb-item:first-child::before {
            display: none;
        }

        /* Product Card Styles */
        .product-card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .product-card .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .product-card .card-body {
            padding: 1.25rem;
        }

        .product-card .card-title {
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .product-card .card-text {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .product-card .price-block {
            margin-top: 1rem;
        }

        .product-card .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
        }

        .section-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .section-header h3 {
            color: #333;
            font-weight: 600;
        }

        .section-header p {
            color: #6c757d;
            margin-bottom: 0;
        }
    </style>


    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro text-center">
                <h2>Detail</h2>
                <ul class="bread-crumb d-inline-block">
                    <li class="has-separator d-inline-block mx-2">
                        <a href="{{ url('/') }}" class="text-decoration-none font-weight-bold"
                            style="color: #6c5dd4; border: none;">Home</a>
                    </li>
                    <li class="is-marked d-inline-block mx-2">
                        <a href="" class="text-decoration-none font-weight-bold"
                            style="color: #6c5dd4; border: none;">Details</a>
                    </li>
                </ul>
            </div>
        </div>
    </div><br><br>

    <!-- Page Introduction Wrapper /- -->
    <!-- Single-Product-Full-Width-Page -->
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <!-- Product-Detail -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    {{-- Product Image Gallery --}}
                    <div class="product-gallery mb-4">
                        <div class="main-image-container mb-3">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"> {{-- EasyZoom plugin --}}
                                <a href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}"
                                    class="main-image-link">
                                    <img src="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}"
                                        alt="{{ $productDetails['product_name'] }}" class="img-fluid rounded shadow-sm"
                                        style="width: 100%; height: auto; object-fit: cover;">
                                </a>
                            </div>
                        </div>

                        <div class="thumbnails-container">
                            <div class="row">
                                <div class="col-3 mb-3">
                                    <a href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}"
                                        data-standard="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}"
                                        class="thumbnail-link active">
                                        <img src="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}"
                                            class="img-fluid rounded shadow-sm" alt="Thumbnail">
                                    </a>
                                </div>

                                @foreach ($productDetails['images'] as $image)
                                    <div class="col-3 mb-3">
                                        <a href="{{ asset('front/images/product_images/large/' . $image['image']) }}"
                                            data-standard="{{ asset('front/images/product_images/small/' . $image['image']) }}"
                                            class="thumbnail-link">
                                            <img src="{{ asset('front/images/product_images/small/' . $image['image']) }}"
                                                class="img-fluid rounded shadow-sm" alt="Thumbnail">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-details -->
                    <div class="all-information-wrapper">


                        @if (Session::has('error_message'))
                            <!-- Check AdminController.php, updateAdminPassword() method -->
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        @if (Session::has('success_message'))
                            <!-- Check AdminController.php, updateAdminPassword() method -->
                            <div class="alert alert-success alert-dismissible fade show" role="alert">


                                <strong>Success:</strong> @php echo Session::get('success_message') @endphp {{-- Displaying Unescaped Data: https://laravel.com/docs/9.x/blade#displaying-unescaped-data --}}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        <div class="section-1-title-breadcrumb-rating">
                            <div class="product-title mb-4">
                                <h1 class="h2 font-weight-bold">
                                    {{ $productDetails['product_name'] }}
                                    <span class="badge badge-secondary">{{ $productDetails['condition'] }}</span>
                                </h1>
                            </div>

                            {{-- Breadcrumb Navigation --}}
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent p-0 mb-4">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}" class="text-decoration-none"
                                            style="color: #6c5dd4;">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript:;" class="text-decoration-none"
                                            style="color: #6c5dd4;">{{ $productDetails['section']['name'] }}</a>
                                    </li>

                                    @php
                                        // Split the breadcrumb string at " / "
                                        $breadcrumbLinks = explode(' / ', $categoryDetails['breadcrumbs']);
                                    @endphp

                                    @foreach ($breadcrumbLinks as $link)
                                        <li class="breadcrumb-item">
                                            {{-- Add your color and remove underline --}}
                                            {!! str_replace('<a ', '<a style="color:#6c5dd4; text-decoration:none;" ', $link) !!}
                                        </li>
                                    @endforeach


                                </ol>
                            </nav>

                            {{-- Product Rating Summary --}}
                            {{-- <div class="product-rating mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="rating-stars mr-2">
                                        @if ($avgStarRating > 0)
                                            @php
                                                $star = 1;
                                                while ($star <= 5):
                                            @endphp
                                                <span style="color: {{ $star <= $avgStarRating ? '#ffc700' : '#ccc' }}; font-size: 20px">★</span>
                                            @php
                                                $star++;
                                                endwhile;
                                            @endphp
                                        @endif
                                    </div>
                                    <div class="rating-number">
                                        <span class="font-weight-bold">{{ $avgRating }}</span>
                                        <span class="text-muted">({{ count($ratings) }} Reviews)</span>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- Product Stock --}}
                            <div class="product-stock mb-3">
                                <span class="text-muted mb-1">Stock:</span>
                                <span class="font-weight-bold">{{ $totalStock > 0 ? $totalStock : 'Out of Stock' }}</span>
                            </div>

                            {{-- Product Key Information --}}
                            <div class="product-info mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="text-muted mb-1">Publisher</label>
                                            <div class="font-weight-bold">{{ $productDetails->publisher->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="info-item mb-3">
                                            <label class="text-muted mb-1">Authors</label>
                                            <div class="font-weight-bold">
                                                {{ $productDetails->authors->pluck('name')->join(', ') ?: 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="text-muted mb-1">ISBN</label>
                                            <div class="font-weight-bold">ISBN-{{ $productDetails['product_isbn'] }}</div>
                                        </div>
                                        <div class="info-item mb-3">
                                            <label class="text-muted mb-1">Language</label>
                                            <div class="font-weight-bold">{{ $productDetails->language->name ?? 'N/A' }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- location --}}
                            @php
                            $userLat = session('user_latitude');
                            $userLng = session('user_longitude');
                            $productLatLng = $productDetails->location ? explode(',', $productDetails->location) : [null, null];
                            $distance = null;
                            if ($userLat && $userLng && $productLatLng[0] && $productLatLng[1]) {
                                $distance = \App\Helpers\Helper::getDistance(
                                    $userLat,
                                    $userLng,
                                    $productLatLng[0],
                                    $productLatLng[1],
                                );
                            }
                        @endphp
                            <p>
                                <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M309.2 584.776h105.5l-49 153.2H225.8c-7.3 0-13.3-6-13.3-13.3 0-2.6 0.8-5.1 2.2-7.3l83.4-126.7c2.5-3.6 6.7-5.9 11.1-5.9z"
                                            fill="#FFFFFF"></path>
                                        <path
                                            d="M404.5 791.276H225.8c-36.7 0-66.5-29.8-66.5-66.5 0-13 3.8-25.7 11-36.6l83.4-126.7c12.3-18.7 33.1-29.9 55.5-29.9h178.4l-83.1 259.7z m-95.3-206.5c-4.5 0-8.6 2.2-11.1 6l-83.4 126.7c-1.4 2.2-2.2 4.7-2.2 7.3 0 7.3 6 13.3 13.3 13.3h139.9l49-153.2H309.2z"
                                            fill="#333333"></path>
                                        <path d="M454.6 584.776h109.6l25.3 153.3H429.3z" fill="#FFFFFF"></path>
                                        <path
                                            d="M652.2 791.276H366.6l42.8-259.6h200l42.8 259.6z m-222.9-53.2h160.2l-25.3-153.3H454.6l-25.3 153.3z"
                                            fill="#333333"></path>
                                        <path
                                            d="M618.6 584.776h105.5c4.5 0 8.6 2.2 11.1 6l83.5 126.7c4 6.1 2.3 14.4-3.8 18.4-2.2 1.4-4.7 2.2-7.3 2.2H667.7l-49.1-153.3z"
                                            fill="#FFFFFF"></path>
                                        <path
                                            d="M807.6 791.276H628.9l-83.1-259.7h178.4c22.4 0 43.2 11.2 55.5 29.9l83.4 126.7c9.8 14.8 13.2 32.6 9.6 50s-13.7 32.3-28.6 42.1c-10.8 7.2-23.5 11-36.5 11z m-139.9-53.2h139.9c2.6 0 5.1-0.8 7.3-2.2 4-2.6 5.3-6.4 5.7-8.4 0.4-2 0.7-6-1.9-10l-83.4-126.6c-2.5-3.8-6.6-6-11.1-6H618.6l49.1 153.2z"
                                            fill="#333333"></path>
                                        <path
                                            d="M534.1 639.7C652.5 537.4 711.7 445.8 711.7 365c0-127-102.7-212.1-195-212.1s-195 85.1-195 212.1c0 80.8 59.2 172.3 177.7 274.7 9.9 8.6 24.7 8.6 34.7 0z"
                                            fill="#8CAAFF"></path>
                                        <path
                                            d="M516.7 672.7c-12.5 0-24.9-4.3-34.8-12.9C356.2 551.2 295.1 454.7 295.1 365c0-142.8 114.6-238.7 221.6-238.7S738.3 222.2 738.3 365c0 89.7-61.1 186.2-186.9 294.8-9.8 8.6-22.3 12.9-34.7 12.9z m0-493.2c-79.7 0-168.4 76.2-168.4 185.5 0 72.3 56.7 158 168.4 254.6C628.5 523 685.1 437.3 685.1 365c0-109.3-88.7-185.5-168.4-185.5z"
                                            fill="#333333"></path>
                                        <path d="M516.7 348m-97.5 0a97.5 97.5 0 1 0 195 0 97.5 97.5 0 1 0-195 0Z"
                                            fill="#FFFFFF">
                                        </path>
                                        <path
                                            d="M516.7 472.1c-68.4 0-124.1-55.7-124.1-124.1s55.7-124.1 124.1-124.1S640.8 279.5 640.8 348 585.1 472.1 516.7 472.1z m0-195.1c-39.1 0-70.9 31.8-70.9 70.9 0 39.1 31.8 70.9 70.9 70.9s70.9-31.8 70.9-70.9c0-39.1-31.8-70.9-70.9-70.9z"
                                            fill="#333333"></path>
                                    </g>
                                </svg> :
                                <span>
                                    @if ($distance !== null)
                                        {{ $distance < 1 ? round($distance * 1000) . ' m' : round($distance, 2) . ' km' }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </p>

                            {{-- Product Price Section --}}
                            <div class="product-price mb-4">
                                @php
                                    $originalPrice = $productDetails['product_price'];
                                    $discountedPrice = \App\Models\Product::getDiscountPrice($productDetails['id']);
                                    $savings = $originalPrice - $discountedPrice;
                                    $savingsPercentage =
                                        $originalPrice > 0 && $savings > 0 ? ($savings / $originalPrice) * 100 : 0;
                                @endphp

                                <div class="price-container">
                                    @if ($discountedPrice > 0)
                                        <div class="current-price">
                                            <span class="currency">₹</span>
                                            <span class="amount h2 font-weight-bold"
                                                style="color: #6c5dd4;">{{ $discountedPrice }}</span>
                                        </div>
                                        <div class="original-price">
                                            <span class="text-muted mr-2">M.R.P.:</span>
                                            <span
                                                class="strike-through text-muted"><del>₹{{ $originalPrice }}</del></span>
                                        </div>
                                        <div class="savings mt-2">
                                            <span class="badge badge-success">
                                                Save {{ number_format($savingsPercentage, 1) }}%
                                            </span>
                                        </div>
                                    @else
                                        <div class="current-price">
                                            <span class="currency">₹</span>
                                            <span class="amount h2 font-weight-bold"
                                                style="color: #6c5dd4;">{{ $originalPrice }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Product Description --}}
                        <div class="product-description mb-4">
                            <h6 class="font-weight-bold mb-3">Description</h6>
                            <p class="text-muted">{{ $productDetails['description'] }}</p>
                        </div>

                        {{-- Vendor Information --}}
                        @if (isset($productDetails['vendor']))
                            <div class="vendor-info mb-4">
                                <h6 class="font-weight-bold mb-2">Seller Information</h6>
                                <a href="/products/{{ $productDetails['vendor']['id'] }}" class="text-decoration-none">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-store mr-2" style="color: #6c5dd4;"></i>
                                        <span>{{ $productDetails['vendor']['vendorbusinessdetails']['shop_name'] }}</span>
                                    </div>
                                </a>
                            </div>
                        @endif



                        {{-- Add to Cart Form --}}
                        <form action="{{ url('cart/add') }}" method="Post" class="post-form">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">

                            <div class="add-to-cart-section mb-4">
                                {{-- Quantity Selector --}}
                                <div class="quantity-selector mb-3">
                                    <label class="font-weight-bold mb-2">Quantity</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="decrementQuantity()">-</button>
                                        </div>

                                        <input type="number" class="form-control text-center" name="quantity"
                                            id="quantity" value="1" min="1" style="border-color: #6c5dd4;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="incrementQuantity()">+</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="action-buttons">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-2">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                style="background-color: #6c5dd4; border-color: #6c5dd4;">
                                                <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                                            </button>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-outline-secondary flex-grow-1 mr-2">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary flex-grow-1">
                                                    <i class="far fa-envelope"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Delivery Check --}}
                        <div class="delivery-check mb-4">
                            <h6 class="font-weight-bold mb-3">Check Delivery Availability</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode"
                                    style="border-color: #6c5dd4;">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="checkPincode"
                                        style="border-color: #6c5dd4; color: #6c5dd4;">
                                        Check
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Add this JavaScript for quantity controls --}}
                        <script>
                            function incrementQuantity() {
                                const input = document.getElementById('quantity');
                                input.value = parseInt(input.value) + 1;
                            }

                            function decrementQuantity() {
                                const input = document.getElementById('quantity');
                                if (parseInt(input.value) > 1) {
                                    input.value = parseInt(input.value) - 1;
                                }
                            }
                        </script>

                    </div>
                    <!-- Product-details /- -->
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-80">
                        <div class="detail-nav-wrapper u-s-m-b-30">
                            <ul class="nav single-product-nav justify-content-center">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#detail">Product Details</a>
                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" data-toggle="tab" href="#review">Reviews {{ count($ratings) }}</a>
                                </li>
                            </ul>
                        </div> --}}

            <!-- Description-Tab /- -->
            <!-- Details-Tab -->
            {{-- <div class="tab-pane fade" id="detail">
                                <div class="specification-whole-container">
                                    <div class="spec-table u-s-m-b-50">
                                        <h4 class="spec-heading">Product Details</h4>
                                        <table>
                                            @php
                                                $productFilters = \App\Models\ProductsFilter::productFilters(); // Get ALL the (enabled/active) Filters
                                                // dd($productFilters);
                                            @endphp

                                            @foreach ($productFilters as $filter) {{-- show ALL the (enabled/active) Filters --}}
            {{-- @php
                                                    // echo '<pre>', var_dump($product), '</pre>';
                                                    // exit;
                                                    // echo '<pre>', var_dump($filter), '</pre>';
                                                    // exit;
                                                    // dd($filter);
                                                @endphp --}}

            {{-- @if (isset($productDetails['category_id']))
                                                    @php
                                                        // dd($filter);

                                                        $filterAvailable = \App\Models\ProductsFilter::filterAvailable($filter['id'], $productDetails['category_id']);
                                                    @endphp

                                                    @if ($filterAvailable == 'Yes') if the filter has the current productDetails['category_id'] in its `cat_ids` --}}

            {{-- <tr>
                                                            <td>{{ $filter['filter_name'] }}</td>
                                                            <td>
                                                                @foreach ($filter['filter_values'] as $value) {{-- show the related values of the filter of the product --}}
            {{-- @php
                                                                        // echo '<pre>', var_dump($value), '</pre>'; exit;
                                                                    @endphp --}}
            {{-- @if (!empty($productDetails[$filter['filter_column']]) && $productDetails[$filter['filter_column']] == $value['filter_value']) {{-- $value['filter_value'] is like '4GB' --}} {{-- $productDetails[$filter['filter_column']]    is like    $productDetails['screen_size']    which in turn, may be equal to    '5 to 5.4 in' --}}
            {{-- {{ ucwords($value['filter_value']) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr> --}}

            {{-- @endif
                                                @endif
                                            @endforeach



                                        </table>
                                    </div>
                                </div>
                            </div> --}}
            <!-- Specifications-Tab /- -->
            <!-- Reviews-Tab -->
            {{-- <div class="tab-pane fade" id="review">
                                <div class="review-whole-container">
                                    <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-score-wrapper">
                                                <h6 class="review-h6">Average Rating</h6>
                                                <div class="circle-wrapper">
                                                    <h1>{{ $avgRating }}</h1>
                                                </div>
                                                <h6 class="review-h6">Based on {{ count($ratings) }} Reviews</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-star-meter">
                                                <div class="star-wrapper">
                                                    <span>5 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{ $ratingFiveStarCount }})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>4 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{ $ratingFourStarCount }})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>3 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{ $ratingThreeStarCount }})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>2 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{ $ratingTwoStarCount }})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>1 Star</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{ $ratingOneStarCount }})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-12">


                                            {{-- Star Rating (of a Product) (in the "Reviews" tab). --}}
            {{-- <form method="POST" action="{{ url('add-rating') }}" name="formRating" id="formRating"> --}}
            @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}
            {{--
                                                <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                                <div class="your-rating-wrapper">
                                                    <h6 class="review-h6">Your Review matters.</h6>
                                                    <h6 class="review-h6">Have you used this product before?</h6>
                                                    <div class="star-wrapper u-s-m-b-8"> --}}


            {{-- Star Rating (of a Product) (in the "Reviews" tab). --}}
            {{-- <div class="rate">
                                                            <input style="display: none" type="radio" id="star5" name="rating" value="5" />
                                                            <label for="star5" title="text">5 stars</label>

                                                            <input style="display: none" type="radio" id="star4" name="rating" value="4" />
                                                            <label for="star4" title="text">4 stars</label>

                                                            <input style="display: none" type="radio" id="star3" name="rating" value="3" />
                                                            <label for="star3" title="text">3 stars</label>

                                                            <input style="display: none" type="radio" id="star2" name="rating" value="2" />
                                                            <label for="star2" title="text">2 stars</label>

                                                            <input style="display: none" type="radio" id="star1" name="rating" value="1" />
                                                            <label for="star1" title="text">1 star</label>
                                                        </div>


                                                    </div>
                                                        <textarea class="text-area u-s-m-b-8" id="review-text-area" placeholder="Your Review" name="review" required></textarea>
                                                        <button class="button button-outline-secondary">Submit Review</button>
                                                    {{-- </form> --}}
            {{-- </div>
                                            </form>


                                        </div>
                                    </div> --}}
            <!-- Get-Reviews -->
            {{-- <div class="get-reviews u-s-p-b-22">
                                        <!-- Review-Options -->
                                        <div class="review-options u-s-m-b-16">
                                            <div class="review-option-heading">
                                                <h6>Reviews
                                                    <span> ({{ count($ratings) }}) </span>
                                                </h6>
                                            </div>
                                        </div> --}}
            <!-- Review-Options /- -->
            <!-- All-Reviews -->
            {{-- <div class="reviewers">

                                            {{-- Display/Show user's Ratings --}}
            {{-- @if (count($ratings) > 0) {{-- if there're any ratings for the product --}}
            {{-- @foreach ($ratings as $rating)
                                                    <div class="review-data">
                                                        <div class="reviewer-name-and-date">
                                                            <h6 class="reviewer-name">{{ $rating['user']['name'] }}</h6>
                                                            <h6 class="review-posted-date">{{ date('d-m-Y H:i:s', strtotime($rating['created_at'])) }}</h6>
                                                        </div>
                                                        <div class="reviewer-stars-title-body">
                                                            <div class="reviewer-stars">


                                                                {{-- Show/Display the Star Rating of the Review/Rating --}}
            {{-- @php
                                                                    $count = 0;

                                                                    // Show the stars
                                                                    while ($count < $rating['rating']): // while $count is 0, 1, 2, 3, 4, or 5 Stars
                                                                @endphp --}}
            {{-- <span style="color: gold">&#9733;</span> {{-- "BLACK STAR" HTML Entity --}} {{-- HTML Entities: https://www.w3schools.com/html/html_entities.asp --}}

            {{-- @php
                                                                        $count++;
                                                                    endwhile;
                                                                @endphp

{{--
                                                            </div> --}}
            {{-- <p class="review-body">
                                                                {{ $rating['review'] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div> --}}
            <!-- All-Reviews /- -->
            <!-- Pagination-Review -->

            <!-- Pagination-Review /- -->
            {{-- </div> --}}
            <!-- Get-Reviews /- -->
            {{-- </div>
                            </div>
                            <!-- Reviews-Tab /- -->
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Detail-Tabs /- -->
            <!-- Different-Product-Section -->
            <div class="detail-different-product-section u-s-p-t-80">
                <!-- Similar Products -->
                <section class="section-maker">
                    <div class="container">
                        <div class="section-header mb-4">
                            <h3 class="h4 mb-0 d-flex align-items-center">
                                <i class="fas fa-book me-2" style="color: #6c5dd4;"></i>
                                Similar Books
                            </h3>
                            <p class="text-muted mt-2 mb-0">Books you might also like</p>
                        </div>

                        <div class="similar-products-slider">
                            <div class="row">
                                @forelse($similarProducts as $product)
                                    <div class="col-md-3 mb-4">
                                        <div class="card h-100 border-0 shadow-sm product-card">
                                            <div class="position-relative">
                                                <a href="{{ url('product/' . $product['id']) }}">
                                                    @php
                                                        $product_image_path =
                                                            'front/images/product_images/small/' .
                                                            $product['product_image'];
                                                    @endphp

                                                    @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                        <img class="card-img-top" src="{{ asset($product_image_path) }}"
                                                            alt="{{ $product['product_name'] }}"
                                                            style="height: 200px; object-fit: cover;">
                                                    @else
                                                        <img class="card-img-top"
                                                            src="{{ asset('front/images/product_images/small/no-image.png') }}"
                                                            alt="No Image" style="height: 200px; object-fit: cover;">
                                                    @endif
                                                </a>

                                                @php
                                                    $discount = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp

                                                @if ($discount > 0)
                                                    <div class="position-absolute top-0 end-0 m-2">
                                                        <span class="badge bg-danger">
                                                            Save
                                                            {{ number_format((($product['product_price'] - $discount) / $product['product_price']) * 100, 0) }}%
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title mb-1" style="height: 40px; overflow: hidden;">
                                                    <a href="{{ url('product/' . $product['id']) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ Str::limit($product['product_name'], 40) }}
                                                    </a>
                                                </h5>

                                                {{-- <p class="text-muted small mb-2" style="height: 40px; overflow: hidden;">
                                                    {{ Str::limit($product['description'], 60) }}
                                                </p> --}}

                                                <p class="text-muted small mb-2">Publisher:
                                                    {{ $product['publisher']['name'] ?? 'N/A' }}</p>
                                                <p class="text-muted small mb-2">Authors:
                                                    @if (!empty($product['authors']))
                                                        @foreach ($product['authors'] as $author)
                                                            {{ $author['name'] }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>


                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="price-block">
                                                        @if ($discount > 0)
                                                            <span
                                                                class="text-danger"><del>₹{{ $product['product_price'] }}</del></span>
                                                            <span class="h5 mb-0 ms-2">₹{{ $discount }}</span>
                                                        @else
                                                            <span class="h5 mb-0">₹{{ $product['product_price'] }}</span>
                                                        @endif
                                                    </div>
                                                    <span class="badge" style="background-color: #6c5dd4;">
                                                        {{ ucfirst($product['condition']) }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card-footer bg-white border-top-0 p-3">
                                                <div class="d-grid">
                                                    <a href="{{ url('product/' . $product['id']) }}"
                                                        class="btn btn-outline-primary btn-sm"
                                                        style="border-color: #6c5dd4; color: #6c5dd4;">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                No similar products found.
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Recently Viewed Products -->
                    <section class="section-maker mt-5">
                        <div class="container">
                            <div class="section-header mb-4">
                                <h3 class="h4 mb-0 d-flex align-items-center">
                                    <i class="fas fa-history me-2" style="color: #6c5dd4;"></i>
                                    Recently Viewed
                                </h3>
                                <p class="text-muted mt-2 mb-0">Books you've viewed recently</p>
                            </div>

                            <div class="recently-viewed-slider">
                                <div class="row">
                                    @forelse($recentlyViewedProducts as $product)
                                        <div class="col-md-3 mb-4">
                                            <div class="card h-100 border-0 shadow-sm product-card">
                                                <div class="position-relative">
                                                    <a href="{{ url('product/' . $product['id']) }}">
                                                        @php
                                                            $product_image_path =
                                                                'front/images/product_images/small/' .
                                                                $product['product_image'];
                                                        @endphp

                                                        @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                            <img class="card-img-top" src="{{ asset($product_image_path) }}"
                                                                alt="{{ $product['product_name'] }}"
                                                                style="height: 200px; object-fit: cover;">
                                                        @else
                                                            <img class="card-img-top"
                                                                src="{{ asset('front/images/product_images/small/no-image.png') }}"
                                                                alt="No Image" style="height: 200px; object-fit: cover;">
                                                        @endif
                                                    </a>

                                                    @php
                                                        $discount = \App\Models\Product::getDiscountPrice(
                                                            $product['id'],
                                                        );
                                                    @endphp

                                                    @if ($discount > 0)
                                                        <div class="position-absolute top-0 end-0 m-2">
                                                            <span class="badge bg-danger">
                                                                Save
                                                                {{ number_format((($product['product_price'] - $discount) / $product['product_price']) * 100, 0) }}%
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="card-body">
                                                    <h5 class="card-title mb-1" style="height: 40px; overflow: hidden;">
                                                        <a href="{{ url('product/' . $product['id']) }}"
                                                            class="text-decoration-none text-dark">
                                                            {{ Str::limit($product['product_name'], 40) }}
                                                        </a>
                                                    </h5>

                                                    {{-- <p class="text-muted small mb-2" style="height: 40px; overflow: hidden;">
                                                    {{ Str::limit($product['description'], 60) }}
                                                </p> --}}

                                                    <p class="text-muted small mb-2">Publisher:
                                                        {{ $product['publisher']['name'] ?? 'N/A' }}</p>
                                                    <p class="text-muted small mb-2">Authors:
                                                        @if (!empty($product['authors']))
                                                            @foreach ($product['authors'] as $author)
                                                                {{ $author['name'] }}@if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            N/A
                                                        @endif
                                                    </p>

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="price-block">
                                                            @if ($discount > 0)
                                                                <span
                                                                    class="text-danger"><del>₹{{ $product['product_price'] }}</del></span>
                                                                <span class="h5 mb-0 ms-2">₹{{ $discount }}</span>
                                                            @else
                                                                <span class="h5 mb-0">₹{{ $product['product_price'] }}</span>
                                                            @endif
                                                        </div>
                                                        <span class="badge" style="background-color: #6c5dd4;">
                                                            {{ ucfirst($product['condition']) }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="card-footer bg-white border-top-0 p-3">
                                                    <div class="d-grid">
                                                        <a href="{{ url('product/' . $product['id']) }}"
                                                            class="btn btn-outline-primary btn-sm"
                                                            style="border-color: #6c5dd4; color: #6c5dd4;">
                                                            View Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="alert alert-info">
                                                    No recently viewed products.
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <style>
                        .product-card {
                            transition: all 0.3s ease;
                        }

                        .product-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
                        }

                        .section-header {
                            border-bottom: 2px solid #f0f0f0;
                            padding-bottom: 1rem;
                        }

                        .card-img-top {
                            border-top-left-radius: 0.5rem;
                            border-top-right-radius: 0.5rem;
                        }

                        .badge {
                            font-weight: 500;
                            padding: 0.5em 0.75em;
                        }
                    </style>
                </div>
            </div>
            <!-- Single-Product-Full-Width-Page /- -->


        @endsection
