<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link id="googleFonts"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap"
          rel="stylesheet"
          type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/animate/animate.compat.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/css/theme-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/css/theme-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/css/theme-shop.css') }}">

    <!-- Skin CSS -->
    <link id="skinCSS" rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/css/skins/default.css') }}">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('Porto_v9.5_HTML/HTML/css/custom.css') }}">

    <script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/modernizr/modernizr.min.js') }}"></script>
</head>
<body data-plugin-page-transition>
<div class="body">
    <header id="header" class="header-effect-shrink"
            data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}">
        <div class="header-body border-top-0">
            <div class="header-top">
                <div class="container">
                    <div class="header-row py-2">
                        <div class="header-column justify-content-start">
                            <div class="header-row">
                                <nav class="header-nav-top">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                            <a class="nav-link ps-0" href="#"><i class="fas fa-angle-right"></i> About Us</a>
                                        </li>
                                        <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                            <a class="nav-link" href="#"><i class="fas fa-angle-right"></i> Contact Us</a>
                                        </li>
                                        <li class="nav-item dropdown nav-item-left-border d-none d-sm-block nav-item-left-border-remove nav-item-left-border-md-show">
                                            <a class="nav-link" href="#" role="button" id="dropdownLanguage"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('Porto_v9.5_HTML/HTML/img/blank.gif') }}" class="flag flag-us" alt="English" />
                                                English
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownLanguage">
                                                <a class="dropdown-item" href="#"><img src="{{ asset('Porto_v9.5_HTML/HTML/img/blank.gif') }}" class="flag flag-us" alt="English" /> English</a>
                                                <a class="dropdown-item" href="#"><img src="{{ asset('Porto_v9.5_HTML/HTML/img/blank.gif') }}" class="flag flag-es" alt="Español" /> Español</a>
                                                <a class="dropdown-item" href="#"><img src="{{ asset('Porto_v9.5_HTML/HTML/img/blank.gif') }}" class="flag flag-fr" alt="Française" /> Française</a>
                                            </div>
                                        </li>
                                        <li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-sm-show">
                                            <span class="ws-nowrap"><i class="fas fa-phone"></i> (123) 456-789</span>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-column justify-content-end">
                            <div class="header-row">
                                <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">
                                    <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-logo">
                                <a href="{{ url('/') }}">
                                    <img alt="{{ config('app.name', 'Laravel') }}" width="100" height="48"
                                         data-sticky-width="82" data-sticky-height="40"
                                         src="{{ asset('Porto_v9.5_HTML/HTML/img/logo-default-slim.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
                                <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="{{ url('/') }}">Home</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ url('/') }}">Homepage</a></li>
                                                </ul>
                                            </li>

                                            @guest
                                                @if (Route::has('login'))
                                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                                @endif
                                                @if (Route::has('register'))
                                                    <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                                                @endif
                                            @else
                                                <li><a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a></li>
                                            @endguest
                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>

                            <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                    <a href="#" class="header-nav-features-toggle text-decoration-none" data-focus="headerSearch">
                                        <i class="fas fa-search header-nav-top-icon"></i>
                                    </a>
                                    <div class="header-nav-features-dropdown" id="headerTopSearchDropdown">
                                        <form role="search" action="#" method="get">
                                            <div class="simple-search input-group">
                                                <input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
                                                <button class="btn" type="submit">
                                                    <i class="fas fa-search header-nav-top-icon"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div role="main" class="main">
        <section class="section border-0 m-0">
            <div class="container py-5">
                <h1 class="text-8 font-weight-bold mb-2">Welcome</h1>
                <p class="text-4 mb-0">{{ __('menupage::menupage.welcome') }}</p>
            </div>
        </section>
    </div>
</div>

<!-- Vendor -->
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/jquery.cookie/jquery.cookie.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/lazysizes/lazysizes.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('Porto_v9.5_HTML/HTML/vendor/vide/jquery.vide.min.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('Porto_v9.5_HTML/HTML/js/theme.js') }}"></script>

<!-- Theme Custom -->
<script src="{{ asset('Porto_v9.5_HTML/HTML/js/custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('Porto_v9.5_HTML/HTML/js/theme.init.js') }}"></script>
</body>
</html>
