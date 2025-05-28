<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (!empty($meta_title))
            {{ $meta_title }}
        @else
            Laravel Multi Vendor E-commerce Template - By Multi-vendor E-commerce Application Channel
        @endif
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/images/favicon/android-icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/favicon/manifest.json') }}">

    <!-- Meta -->
    @if (!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    @if (!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

</head>

<body>

    <header class="site-header header-style-two">
        <div class="site-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg navigation-area">
                            <!--~./ ======================= start site logo block ========== -->
                            <div class="site-logo-block">
                                <a class="navbar-brand site-logo" href="{{ url('/') }}">
                                    <img alt="logo" src="{{ asset('front/images/main-logo/logo.png') }}">
                                </a>
                            </div>
                            <div class="mainmenu-area">
                                <nav class="menu">
                                    <ul id="nav">
                                        <!-- ========== Start Dropdown Category ========= -->

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Change Condition (currently {{ ucfirst($condition) }})
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="set('new')">New</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="set('old')">Old</a></li>
                                            </ul>
                                        </li>


                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown">Language</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">English</a></li>
                                                <li><a class="dropdown-item" href="#">Français</a></li>
                                            </ul>
                                        </li>


                                        {{-- <li class="dropdown-trigger">
                                            <a href="#">{!! __('main.Categories') !!}</a>
                                            <ul class="dropdown-content">
                                                @foreach (Catalls() as $Catall)
                                                    <li>
                                                        <a href="{!! url('Cat') !!}/{!! $Catall->slug !!}">
                                                            {!! $Catall->{'Title_' . $Locale} !!}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="dropdown-trigger">
                                            <a href="#">{!! __('main.Language') !!}</a>
                                            <ul class="dropdown-content">
                                                @if (option('Language') == 'on')
                                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                        <li>
                                                            <a rel="alternate" hreflang="{!! $localeCode !!}"
                                                                href="{!! LaravelLocalization::getLocalizedURL($localeCode, null, [], true) !!}">
                                                                {!! $properties['native'] !!}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                @endif
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-navigation-right">
                                <!--~./ ============================ search-wrap ============================ ~-->
                                @guest
                                    <a class="btn text-white mr-2" style="background-color: #6c5dd4;"
                                        href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i> Login/Register
                                    </a>
                                @else
                                    <div class="d-flex align-items-center justify-content-end">
                                        <img class="rounded-circle me-2"
                                            src="{{ asset(Auth::user()->ImageUpload->filename ?? 'assets/images/avatar.png') }}"
                                            width="35" height="35">
                                        <span class="me-2">{{ Auth::user()->name }}</span>
                                        <a class="btn btn-outline-light btn-sm" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                                <!--~./ ============================ search-wrap ============================ ~-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu">
            <a class="mobile-logo" href="{!! url('') !!}">
                <img alt="logo" src="{{ asset('front/images/main-logo/logo.png') }}" width="30%">
            </a>
        </div>
    </header>


    @yield('content')

    {{-- Modals  --}}
    @include('front.layout.modals')

    {{-- <footer class="site-footer footer-default-style bg-black pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-white">
                    <h5>About Us</h5>
                    <p>Insert your content here</p>
                </div>
                <div class="col-md-4 text-white">
                    <h5>Latest Posts</h5>
                    <p>Insert posts or remove</p>
                </div>
                <div class="col-md-4 text-white">
                    <h5>Categories</h5>
                    <p>Insert categories or remove</p>
                </div>
            </div>
            <div class="row mt-4 border-top pt-3">
                <div class="col-md-6 text-white">
                    <p>© Copyright 2024. All Rights Reserved</p>
                </div>
                <div class="col-md-6 text-end text-white">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">Amazon Associates - Amazon’s affiliate marketing program.</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> --}}

    <footer class="site-footer footer-default-style bg-black pt-80">
        <div class="footer-widget-area pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <aside class="widget bt-about-us-widget">
                            <div class="widget-content">
                                <p>
                                    Bookhub - BookStore Script System is an online Discovering great books website
                                    filled with the latest and best selling Books.
                                </p>
                                <ul class="social-share">
                                    <li><a class="facebook" href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="youtube" href=""><i class="fa fa-youtube"></i></a></li>
                                    <li><a class="instagram" href=""><i class="fa fa-instagram"></i></a></li>
                                    <li><a class="youtube" href=""><i class="fa fa-github"></i></a></li>
                                    <li><a class="youtube" href=""><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-4">
                        <aside class="widget latest-posts-widget">
                            <div class="widget-content">
                                @foreach ($footerProducts as $product)
                                    <article class="post side-post">
                                        <div class="thumb-wrap">
                                            <a href="{{ url('product/' . $product['id']) }}">
                                                <img
                                                    src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}">
                                            </a>
                                        </div>
                                        <div class="content-entry-wrap">
                                            <div>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                            </div>
                                            <h3 class="entry-title">
                                                <a href="{{ url('product/' . $product['id']) }}">
                                                    {{ $product['product_name'] }}
                                                </a>
                                            </h3>
                                            <p>{{ $product['description'] }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget widget-categories">
                            <div class="widget-content">
                                <ul>
                                    @foreach ($category as $cat)
                                        <p>
                                            {{ $cat['category_name'] }}
                                        </p>
                                    @endforeach
                                    {{-- @foreach (FooterCats() as $FooterCat)
                                        <li class="cat-item">
                                            <a href="{!! url('Cat') !!}/{!! $FooterCat->slug !!}">
                                                {!! $FooterCat->{'Title_' . $Locale} !!}<span
                                                    class="count">{!! $FooterCat->id !!}</span>
                                            </a>
                                        </li>
                                    @endforeach --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright-text">
                            <p>{!! __('main.Reserved') !!}</p>
                        </div>
                    </div><!--~./ end copyright ~-->
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-menu">
                            <ul class="list">
                                <li><a>{!! __('main.Amazon_Associates') !!}</a></li>
                            </ul>
                        </div><!--~./ end footer menu ~-->
                    </div>
                </div>
            </div>
        </div>
        <!--~./ end footer bottom area ~-->
    </footer>

    {{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/masonary.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.trackpad-scroll-emulator.min.js') }}"></script>
    <script src="{{ asset('assets/js/ResizeSensor.min.js') }}"></script>
    <script src="{{ asset('assets/js/theia-sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function tclear() {
            localStorage.removeItem('firstVisitShown');
            alert("Local storage cleared! Refresh the page to see the modal again.");
        }
    </script>

    <script>
        function submitCondition(value) {
            const form = document.getElementById('conditionForm');
            document.getElementById('conditionInput').value = value;
            form.submit();
        }
    </script>


    <script>
        function set(condition) {
            fetch("{{ route('set.condition') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        condition: condition
                    }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('firstVisitModal'));
                        if (modal) modal.hide(); // Bootstrap 5
                        localStorage.setItem('firstVisitShown', true);
                        location.reload();
                    }
                });
        }
    </script>

    @include('front.layout.scripts')
</body>

</html>
