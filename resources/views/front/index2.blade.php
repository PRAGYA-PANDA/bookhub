@extends('front.layout.layout2')

@section('content')
<div class="site-content">
    <!-- Frontpage Slider -->
    <div class="frontpage-slider-posts slider-style-two mb-5">
        <div id="frontpage-slider" class="owl-carousel frontpage-slider-two carousel-nav-align-center">
            @foreach ($newProducts as $product)
                <article class="slider-item text-center">
                    <figure class="slider-thumb">
                        @if (!empty($product['product_image']))
                            <img src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}" alt="{{ $product['product_name'] }}" class="img-fluid">
                        @endif
                    </figure>
                    <div class="content-entry-wrap">
                        <div class="entry-content">
                            <h3 class="entry-title">
                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                            </h3>
                            <div class="text-warning">
                                @for ($i = 0; $i < 5; $i++)
                                    <span class="star">&#9733;</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    <!-- Top Stories -->
    <section class="top-stories-block style-two py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title"><b>Recommended for You</b></h2>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <article class="post hentry post-list post-list-small">
                            <!--./ =============== entry-thumb =============== -->
                            <div class="entry-thumb">
                                <figure class="thumb-wrap">
                                    <a>
                                        <img src="{!! asset('assets/images/s1.jpg') !!}">
                                    </a>
                                    <div class="featured-badge-list">
                                        <a class="trending" href="#">
                                            <span class="fa fa-bolt"></span>
                                        </a>
                                    </div>
                                </figure>
                            </div>
                            <!--./ =============== entry-thumb =============== -->
                            <div class="content-entry-wrap">
                                <div class="entry-content">
                                    <h3 class="entry-title">
                                        <a>Quick delivery</a>
                                    </h3>
                                    <!--./ entry-title -->
                                </div>
                                <!--./ entry-content -->
                                <div class="entry-meta-content">
                                    <div class="entry-category">
                                        <span>we swing into action, ensuring that your package reaches your doorstep in the shortest possible time.</span>
                                    </div>
                                </div>
                            </div>
                             <!--./ =============== entry-thumb =============== -->
                        </article>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <article class="post hentry post-list post-list-small">
                            <div class="entry-thumb">
                                <figure class="thumb-wrap">
                                    <a>
                                        <img src="{!! asset('assets/images/s2.jpg') !!}" alt="post">
                                    </a>
                                    <div class="featured-badge-list">
                                        <a class="trending" href="#">
                                            <span class="fas fa-money-check"></span>
                                        </a>
                                    </div>
                                </figure>
                            </div>
                            <!--./ ================= entry-thumb ================= -->
                            <div class="content-entry-wrap">
                                <div class="entry-content">
                                    <h3 class="entry-title">
                                        <a>Secure Payment</a>
                                    </h3>
                                    <!--./ ================= entry-title ========= -->
                                </div>
                                <!--./ ============== entry-content ============== -->
                                <div class="entry-meta-content">
                                    <div class="entry-category">
                                        <span>This encryption process safeguards your information from unauthorized access, ensuring that your data.</span>
                                    </div>
                                </div>
                                </div>
                        </article>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <article class="post hentry post-list post-list-small">
                            <div class="entry-thumb">
                                <figure class="thumb-wrap">
                                    <a>
                                        <img src="{!! asset('assets/images/s4.jpg') !!}">
                                    </a>
                                    <div class="featured-badge-list">
                                        <a class="trending" href="#">
                                            <span class="fas fa-truck-loading"></span>
                                        </a>
                                    </div>
                                    <!--./ ====== featured-badge-list ============== -->
                                </figure>
                            </div>
                            <div class="content-entry-wrap">
                                <div class="entry-content">
                                    <h3 class="entry-title">
                                        <a>Best Quality</a>
                                    </h3><!--./ entry-title -->
                                </div>
                                <!--./ entry-content -->
                                <div class="entry-meta-content">
                                    <div class="entry-category">
                                        <span>We have relationships with trusted suppliers who share our commitment to excellence.</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
        </div>
    </section>

    <!-- Latest Books -->
    <section class="frontpage-popular-posts pb-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title"><b>Latest Book</b></h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($newProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <article class="card h-100">
                            @if (!empty($product['product_image']))
                                <a href="{{ url('product/' . $product['id']) }}">
                                    <img src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}" class="card-img-top" alt="{{ $product['product_name'] }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <div class="text-warning mb-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <span class="star">&#9733;</span>
                                    @endfor
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ url('product/' . $product['id']) }}" class="text-dark">{{ $product['product_name'] }} ({{ $product['condition'] }})</a>
                                </h5>
                                <p class="card-text text-muted">{{ $product->Category->title_en ?? '' }}</p>
                                <span class="fw-bold">Rs. {{ \App\Models\Product::getDiscountPrice($product['id']) }}</span>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <!-- Advertisements -->
            {{-- <div class="row my-4 g-3">
                <div class="col-md-4">
                    <a href="{{ url('') }}">
                        <img src="{{ asset('assets/images/s1.jpg') }}" class="img-fluid" alt="Ad">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('') }}">
                        <img src="{{ asset('assets/images/s4.jpg') }}" class="img-fluid" alt="Ad">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('') }}">
                        <img src="{{ asset('assets/images/s3.jpg') }}" class="img-fluid" alt="Ad">
                    </a>
                </div>
            </div> --}}
        </div>
    </section>
</div>
@endsection
