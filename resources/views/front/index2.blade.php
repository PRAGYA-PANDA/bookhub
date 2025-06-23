@extends('front.layout.layout2')

@section('content')


<style>

@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');

/* code by sumit */

.frontpage-slider-posts.slider-style-two #frontpage-slider{
    height:350px;
    margin-top:50px;
}

.frontpage-slider-posts.slider-style-two #frontpage-slider .owl-stage-outer{
    height:100% !important;
}

.frontpage-slider-posts.slider-style-two #frontpage-slider .slider-item
 {
    background-color:unset !important;
    border-radius:20px;
    border:3px solid rgb(75, 59, 59);
    box-shadow:5px 5px 10px 0px #aea3a3;

 }

 .frontpage-slider-posts.slider-style-two #frontpage-slider .slider-item figure{
    margin-bottom:0px !important;

 }

 .site-content{
    /* background:#FFD4C5;
    background:#F5F2EC; */
    /* background:#FDF1DD; */
    background:#f0f0f0;
 }

 .top-stories-block{
    margin-top:100px;
    margin-bottom:150px;
 }

.top-stories-block .container{
    /* background:conic-gradient(at 0% 100%, rgb(255, 0, 242) 5%,rgb(92, 92, 226) 30%,orangered);     */
    /* background:rgb(213, 139, 255); */
    background:#e6e4e4;
    width:fit-content;
    margin:40px auto;
    padding-inline:30px;
    border-radius:30px;
    /* box-shadow:5px 5px 10px 0px #aea3a3; */
    box-shadow:5px 5px 10px 0px #757373;

}

.top-stories-block h2{
    /* color:rgb(255, 238, 0); */
    /* color:rgb(154, 236, 216); */
    color:black;
    /* text-shadow:3px 3px 3px black; */
}

.entry-category span{
    color:rgb(119, 119, 119) !important;
    font-weight:bold !important;
}

.content-entry-wrap .entry-title a{
    color: black;
    /* text-shadow:3px 3px 3px black; */
}
.content-entry-wrap .entry-title a:hover{
    color:black !important;
}

.frontpage-popular-posts{
    width:100%;
    position:relative;

}


.frontpage-popular-posts h2{


     color:black !important;
    font-weight:bolder;
  text-align: left;
}

.frontpage-popular-posts .card{
    border:2px solid #C0C0C0;
    transition:all 0.4s ease-in-out;
    /* height:55vh !important; */

    /* transform:scale(0.9,0.8); */
}

.frontpage-popular-posts .card img{
    height:200px !important;
}

.frontpage-popular-posts .card:hover{
    scale:1.03;
    cursor:pointer;
}

.oswald-title {
  font-family: "Oswald", sans-serif !important;
  font-optical-sizing: auto !important;
  font-weight: 700 !important;
  font-style: normal !important;
}

@media only screen and (min-width:1400px) {
            .frontpage-popular-posts .card {

                height: 425px !important;

            }
        }

         @media only screen and (max-width:1200px) {
            .frontpage-popular-posts .card {

                height: 460px !important;

            }
        }

        @media only screen and (max-width:768px) {
            .frontpage-popular-posts .card {

                height: fit-content !important;

            }
        }


</style>


    <div class="site-content">
        <!-- Frontpage Slider -->
        <div class="frontpage-slider-posts slider-style-two mb-5">
            <div id="frontpage-slider" class="owl-carousel frontpage-slider-two carousel-nav-align-center">
                @foreach ($newProducts as $product)
                    <div class="slider-item text-center">
                        <figure class="slider-thumb glass-effect">
                            @if (!empty($product['product_image']))
                                <img src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}"
                                    alt="{{ $product['product_name'] }}" class="img-fluid">
                            @endif
                        </figure>
                        <div class="content-entry-wrap">
                            <div class="entry-content card p-2 glass-effect">
                                <h3 class="entry-title">
                                    <a href="{{ url('product/' . $product->id) }}" style="text-decoration: none;">
                                        {{ $product->product_name }}
                                    </a>
                                </h3>
                                <p>Publisher: {{ $product->publisher->name ?? 'N/A' }}</p>
                                <p>Authors:
                                    @if ($product->authors->isNotEmpty())
                                        @foreach ($product->authors as $author)
                                            {{ $author->name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </p>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Stories -->
        <section class="top-stories-block style-two ">
            <div class="container" style="padding-block:40px;">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="section-title oswald-title"><b>Recommended for You</b></h2>
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
                                        <span class="text-light">we swing into action, ensuring that your package reaches your doorstep in the
                                            shortest possible time.</span>
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
                                        <a >Secure Payment</a>
                                    </h3>
                                    <!--./ ================= entry-title ========= -->
                                </div>
                                <!--./ ============== entry-content ============== -->
                                <div class="entry-meta-content">
                                    <div class="entry-category">
                                        <span class="text-light">This encryption process safeguards your information from unauthorized access,
                                            ensuring that your data.</span>
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
                                        <a >Best Quality</a>
                                    </h3><!--./ entry-title -->
                                </div>
                                <!--./ entry-content -->
                                <div class="entry-meta-content">
                                    <div class="entry-category">
                                        <span class="text-light">We have relationships with trusted suppliers who share our commitment to
                                            excellence.</span>
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
                        <h2 class="section-title oswald-title"><b>Latest Book</b></h2>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach ($newProducts as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100">
                                @if (!empty($product['product_image']))
                                    <a href="{{ url('product/' . $product['id']) }}">
                                        <img src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}"
                                            class="card-img-top" alt="{{ $product['product_name'] }}">
                                    </a>
                                @endif
                                <div class="card-body">
                                    {{-- <div class="text-warning mb-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="star">&#9733;</span>
                                        @endfor
                                    </div> --}}
                                    <h5 class="card-title">
                                        <a href="{{ url('product/' . $product['id']) }}"
                                            class="text-dark">{{ $product['product_name'] }}
                                            ({{ $product['condition'] }})
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted">{{ $product->Category->title_en ?? '' }}</p>
                                    <p>Publisher: {{ $product->publisher->name ?? 'N/A' }}</p>
                                     <p>Authors:
                                    @if ($product->authors->isNotEmpty())
                                        @foreach ($product->authors as $author)
                                            {{ $author->name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </p>
                                    <span class="fw-bold">Rs.
                                        {{ \App\Models\Product::getDiscountPrice($product['id']) }}</span>
                                </div>
                            </div>
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
