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
    <meta name="base-url" content="{{ url('') }}">
    <meta name="app-url" content="{{ config('app.url') }}">
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Custom Navigation Styles */
        .mainmenu-area .nav-item {
            margin-right: 10px;
        }

        .mainmenu-area .nav-link {
            color: #333;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .mainmenu-area .nav-link:hover {
            color: #6c5dd4;
            background-color: rgba(108, 93, 212, 0.1);
        }

        .mainmenu-area .dropdown-menu {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 8px 0;
        }

        .mainmenu-area .dropdown-item {
            padding: 8px 20px;
            color: #333;
            transition: all 0.2s ease;
        }

        .mainmenu-area .dropdown-item:hover {
            background-color: rgba(108, 93, 212, 0.1);
            color: #6c5dd4;
        }

        .mainmenu-area .dropdown-divider {
            margin: 4px 0;
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Active state */
        .mainmenu-area .nav-link.active {
            color: #6c5dd4;
            background-color: rgba(108, 93, 212, 0.1);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            /* Light translucent */
            backdrop-filter: blur(10px);
            /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px);
            /* For Safari */
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Subtle border */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Optional soft shadow */
            color: #fff;
            /* Optional: makes text more visible on transparent background */
            transition: all 0.3s ease;
        }

        .glass-effect:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15);
        }
    </style>

</head>

<body>

    <!-- Top Contact Navbar -->
    <div class="full-layer-outer-header border-bottom" style="background-color: rgb(202, 199, 199)">
        <div class="container d-flex justify-content-end align-items-center">
            <nav>
                <ul class="nav">
                    <li class="nav-item me-4">
                        <a class="nav-link text-dark p-0" href="tel:+201255845857">
                            <i class="fas fa-phone text-dark me-2"></i>
                            Telephone: +201255845857
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark p-0" href="mailto:info@multi-vendore-commerce.com">
                            <i class="fas fa-envelope text-dark me-2"></i>
                            E-mail: info@multi-vendore-commerce.com
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <header class="site-header header-style-two">
        <div class="site-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg navigation-area">
                            <!-- Site Logo -->
                            <div class="site-logo-block">
                                <a class="navbar-brand site-logo" href="{{ url('/') }}">
                                    <img alt="logo" src="{{ asset('front/images/main-logo/logo.png') }}">
                                </a>
                            </div>

                            <!-- Navigation Menu -->
                            <div class="mainmenu-area">
                                <nav class="menu">
                                    <ul id="nav" class="navbar-nav">
                                        <!-- Books Menu -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-book me-2"></i>Books
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/search-products') }}">
                                                        <i class="fas fa-list me-2"></i>All Books
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                @foreach ($sections as $section)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/search-products?section_id=' . $section->id) }}">
                                                            {{ $section->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>

                                        <!-- Condition Menu -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-tag me-2"></i>
                                                Condition ({{ ucfirst($condition) }})
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="set('new')">
                                                        <i class="fas fa-star me-2"></i>New
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="set('old')">
                                                        <i class="fas fa-book-open me-2"></i>Old
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <!-- Language Menu -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown">
                                                <i class="fas fa-globe me-2"></i>Language
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="fas fa-flag me-2"></i>English</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="fas fa-flag me-2"></i>Odia</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Right Navigation Items -->
                            <div class="header-navigation-right">
                                <!-- Search Button -->
                                <button type="button" class="btn btn-link me-3" data-bs-toggle="modal"
                                    data-bs-target="#searchModal">
                                    <i class="fas fa-search fa-lg" style="color: #6c5dd4;"></i>
                                </button>

                                <!-- User Account -->
                                @guest
                                    <a class="btn text-white" style="background-color: #6c5dd4;"
                                        href="{{ route('login') }}">
                                        <i class="fas fa-user me-2"></i>Login/Register
                                    </a>
                                @else
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-2"
                                            src="{{ asset(Auth::user()->ImageUpload->filename ?? 'assets/images/avatar.png') }}"
                                            width="35" height="35">
                                        <span class="me-2">{{ Auth::user()->name }}</span>
                                        <a class="btn btn-sm" style="background-color: #6c5dd4; color: white;"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Log out
                                        </a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
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
                        <li class="list-inline-item">Amazon Associates - Amazon's affiliate marketing program.</li>
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
                                            {{-- <div>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                            </div> --}}
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
                            <p>Copyright © Sridipta Research & Development Consultancy Pvt. Ltd.</p>
                        </div>
                    </div><!--~./ end copyright ~-->
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-menu">
                            <ul class="list">
                                <li>
                                    <a href="https://srdcindia.co.in/" target="_blank"
                                        style="text-decoration: none;">
                                        Sridipta Research & Development Consultancy Pvt. Ltd. - Trusted Technology
                                        Partner.
                                    </a>
                                </li>
                            </ul>
                        </div><!--~./ end footer menu ~-->
                    </div>

                </div>
            </div>
        </div>
        <!--~./ end footer bottom area ~-->
    </footer>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
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

    <!-- Full Page Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content glass-modal-full">

                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="text-center mb-3">
                                <img alt="logo" class="glass-img" style="height: 50px;width: 200px;"
                                    src="{{ asset('front/images/main-logo/logo.png') }}">
                            </div>

                            <div class="col-md-8">
                                <h2 class="text-center mb-4">Search Books</h2>
                                <form action="{{ url('/search-products') }}" method="get" id="fullPageSearchForm">
                                    <div class="mb-4">
                                        <div class="input-group input-group-lg">
                                            <input type="text" class="form-control glass-input" name="search"
                                                id="fullPageSearch" placeholder="Search by title, author, ISBN..."
                                                required>

                                            <button class="btn glass-button px-4" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>


                                    <style>
                                        /* Full-page modal glass effect */
                                        .glass-modal-full {
                                            background: rgba(255, 255, 255, 0.1);
                                            /* semi-transparent white */
                                            backdrop-filter: blur(12px);
                                            /* main blur */
                                            -webkit-backdrop-filter: blur(12px);
                                            /* for Safari */
                                            border-radius: 0;
                                            /* full screen - no border */
                                            border: 1px solid rgba(255, 255, 255, 0.2);
                                            color: #fff;
                                            box-shadow: none;
                                            height: 100vh;
                                            overflow-y: auto;
                                        }

                                        .glass-img {
                                            mix-blend-mode: multiply !important;
                                            /* or lighten/darken depending on bg */
                                            background: transparent !important;
                                        }

                                        /* Optional: dark text override if needed */
                                        .glass-modal-full input,
                                        .glass-modal-full select,
                                        .glass-modal-full h2,
                                        .glass-modal-full label,
                                        .glass-modal-full span,
                                        .glass-modal-full button,
                                        .glass-modal-full p {
                                            color: #fff;
                                        }

                                        .glass-modal-full input::placeholder {
                                            color: rgba(255, 255, 255, 0.6);
                                        }

                                        /* Frosted glass effect for buttons */
                                        .glass-button {
                                            background: rgba(255, 255, 255, 0.1);
                                            backdrop-filter: blur(10px);
                                            -webkit-backdrop-filter: blur(10px);
                                            border: 1px solid rgba(255, 255, 255, 0.3);
                                            color: #fff;
                                            border-radius: 10px;
                                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                                            transition: all 0.3s ease;
                                        }

                                        /* Hover effect */
                                        .glass-button:hover {
                                            background: rgba(255, 255, 255, 0.2);
                                            border-color: rgba(255, 255, 255, 0.4);
                                            transform: scale(1.05);
                                        }

                                        /* Optional focus effect */
                                        .glass-button:focus {
                                            outline: none;
                                            box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
                                        }

                                        /* Glass effect for input fields */
                                        .glass-input {
                                            background: rgba(255, 255, 255, 0.1);
                                            backdrop-filter: blur(10px);
                                            -webkit-backdrop-filter: blur(10px);
                                            border: 1px solid rgba(255, 255, 255, 0.3);
                                            color: #fff;
                                            border-radius: 8px;
                                            padding: 0.75rem 1rem;
                                            transition: all 0.3s ease;
                                        }

                                        /* Placeholder color */
                                        .glass-input::placeholder {
                                            color: rgba(255, 255, 255, 0.6);
                                        }

                                        /* Focus effect */
                                        .glass-input:focus {
                                            background: rgba(255, 255, 255, 0.15);
                                            border-color: rgba(255, 255, 255, 0.4);
                                            outline: none;
                                            color: #fff;
                                            box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
                                        }
                                    </style>


                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const slider = document.getElementById('priceRangeSlider');
                                            const minPriceInput = document.getElementById('minPrice');
                                            const maxPriceInput = document.getElementById('maxPrice');
                                            const minPriceDisplay = document.getElementById('priceRangeMin');
                                            const maxPriceDisplay = document.getElementById('priceRangeMax');

                                            // Initialize with default values
                                            let minPrice = 0;
                                            let maxPrice = 10000;

                                            // Update display when slider changes
                                            slider.addEventListener('input', function() {
                                                const value = parseInt(this.value);
                                                minPrice = Math.max(0, value - 2000);
                                                maxPrice = value;

                                                updateDisplay();
                                            });

                                            // Update when min price input changes
                                            minPriceInput.addEventListener('input', function() {
                                                minPrice = parseInt(this.value) || 0;
                                                if (minPrice > maxPrice) {
                                                    maxPrice = minPrice;
                                                    maxPriceInput.value = maxPrice;
                                                }
                                                updateDisplay();
                                            });

                                            // Update when max price input changes
                                            maxPriceInput.addEventListener('input', function() {
                                                maxPrice = parseInt(this.value) || 10000;
                                                if (maxPrice < minPrice) {
                                                    minPrice = maxPrice;
                                                    minPriceInput.value = minPrice;
                                                }
                                                updateDisplay();
                                            });

                                            function updateDisplay() {
                                                minPriceDisplay.textContent = minPrice;
                                                maxPriceDisplay.textContent = maxPrice;
                                                minPriceInput.value = minPrice;
                                                maxPriceInput.value = maxPrice;
                                                slider.value = maxPrice;
                                            }

                                            // Initialize display
                                            updateDisplay();
                                        });
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
