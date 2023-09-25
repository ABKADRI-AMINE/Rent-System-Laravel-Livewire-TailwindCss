<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Location world</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://chir.ag/projects/ntc/ntc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @livewireStyles
</head>
<body class="">
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Discover the ultimate shopping experience!
                                    </li>
                                    <li>Explore a wide range of products and unbeatable deals!
                                    </li>
                                    <li>Experience top-notch service and exclusive discounts!
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            @auth
                                <ul>

                                    <li><a href="{{ route('profile.edit') }}"><i class="fi-rs-user"></i></a>{{ Auth::user()->name }}</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                        </form>
                                    </li>
                                    <li>
                                        @if(auth()->user()->role == 2)
                                            <a href="{{ route('updateRole', ['newRole' => 1]) }}">Become Partner</a>
                                        @else
                                            <a href="{{ route('updateRole', ['newRole' => 2]) }}">Become Client</a>   
                                        @endif
                                    </li>
                                </ul>
                            @else
                                <ul>
                                    <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Log In </a> / <a
                                            href="{{ route('register') }}">Sign
                                            Up</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="header-wrap">
                        <div class="logo logo-width-1">
                            <a href="/"><img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="logo"></a>
                        </div>
                        <div class="header-right">
                            {{-- @livewire('header-search-component') --}}
                            <div class="search-style-1">
                                {{-- <form action="{{route('product.search')}}">
                                    <input type="text" name="q" placeholder="Search for items..." value="{{$q}}">
                                </form> --}}
                            </div>
                            <div class="header-action-right">
                                <div class="header-action-2">

                                    @auth
                                        @livewire('notification-bell')
                                        @livewire('wishlist-icon-component')
                                        @livewire('cart-icon-component')
                                        @livewire('feedback-bell')
                                    @endauth

                                    @guest
                                        <p>You need to log in to see your wishlist, cart, and feedback notifications.</p>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-bottom-bg-color sticky-bar">
                <div class="container">
                    <div class="header-wrap header-space-between position-relative">
                        <div class="logo logo-width-1 d-block d-lg-none">
                            <a href="/"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                        </div>
                        <div class="header-nav d-none d-lg-flex">
                            <div class="main-categori-wrap d-none d-lg-block">
                                <a class="categori-button-active" href="#">
                                    <span class="fi-rs-apps"></span> Browse Categories
                                </a>
                                @livewire('navbar-drop-down')
                            </div>
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                                <nav>
                                    <ul>
                                        <li><a class="{{ request()->routeIs('home.index') ? 'active' : '' }}"
                                                href="/">Home </a></li>
                                        <li><a class="{{ request()->routeIs('shop') ? 'active' : '' }}"
                                                href="{{ route('shop') }}">Shop</a></li>

                                        <li><a class="{{ request()->routeIs('annonce.add') ? 'active' : '' }}"
                                                href="{{ route('annonce.add') }}">Add Announcement</a></li>
                                        <li><a href="{{ route('annonces.mesAnnonces') }}">Announcement</a></li>
                                        {{-- <li><a href="{{ route('annonces.mesAnnonces') }}">Announcement</a></li> --}}
                                        <li><a href="{{ route('demande.page') }}">Reservations</a></li>
                                        <li><a href="{{ route('reclamation') }}">Complains</a></li>
                                        <li><a href="{{ route('object.display') }}">Objects</a></li>
                                        @auth
                                            <li><a href="#">My Account<i class="fi-rs-angle-down"></i></a>

                                                @if (Auth::user()->utype == 'ADM')
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                                        <li><a href="{{ route('admin.products') }}">Products</a></li>
                                                        <li><a href="{{ route('admin.categories') }}">Categories</a></li>
                                                        <li><a href="#">Coupons</a></li>
                                                        <li><a href="#">Orders</a></li>
                                                        <li><a href="#">Customers</a></li>

                                                    </ul>
                                                @else
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                                    </ul>
                                                @endif

                                            </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            {{-- <div class="hotline d-none d-lg-block">
                                <p><i class="fi-rs-smartphone"></i><span>Toll Free</span> (+1) 0000-000-000 </p>
                            </div> --}}
                            <p class="mobile-promotion">Welcome <span class="text-brand">to your location web site</span>.
                            </p>
                            <div class="header-action-right d-block d-lg-none">
                                <div class="header-action-2">
                                    @auth
                                        @livewire('notification-bell')
                                        @livewire('wishlist-icon-component')
                                        @livewire('cart-icon-component')
                                        @livewire('feedback-bell')
                                    @endauth



                                    <div class="header-action-icon-2 d-block d-lg-none">
                                        <div class="burger-icon burger-icon-white">
                                            <span class="burger-icon-top"></span>
                                            <span class="burger-icon-mid"></span>
                                            <span class="burger-icon-bottom"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            @livewireScripts
            @stack('scripts')
            @livewire('serach-annonces')
            <footer class="main">

                <section class="section-padding footer-mid">
                    <div class="container pt-15 pb-20">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="widget-about font-md mb-md-5 mb-lg-0">
                                    <div class="logo logo-width-1 wow fadeIn animated">
                                        <a href="index.html"><img
                                                src="                                    {{ asset('assets/imgs/logo/logo.png') }}
                                            "
                                                alt="logo"></a>
                                    </div>
                                    <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                                    <p class="wow fadeIn animated">
                                        <strong>Address: </strong>Mhannech , Tétouan , Morocco
                                    </p>
                                    <p class="wow fadeIn animated">
                                        <strong>Phone: </strong>(+212) 0000-000-000
                                    </p>
                                    <p class="wow fadeIn animated">
                                        <strong>Email: </strong>contact@locationObject.ma
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <h5 class="widget-title wow fadeIn animated">About</h5>
                                <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                                    <li><a href="{{route('conditions')}}">Terms &amp; Conditions</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-2  col-md-3">
                                <h5 class="widget-title wow fadeIn animated">My Account</h5>
                                <ul class="footer-list wow fadeIn animated">
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="{{ route('shop.cart') }}">View Cart</a></li>
                                    <li><a href="{{ route('shop.wishlist') }}">My Wishlist</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4 mob-center">
                                <h5 class="widget-title wow fadeIn animated">Install App</h5>
                                <div class="row">
                                    <div class="col-md-8 col-lg-12">
                                        <p class="wow fadeIn animated">From App Store or Google Play</p>
                                        <div class="download-app wow fadeIn animated mob-app">
                                            <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                                    src="{{ asset('assets/imgs/theme/app-store.jpg') }}" alt=""></a>
                                            <a href="#" class="hover-up"><img
                                                    src="{{ asset('assets/imgs/theme/google-play.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container pb-20 wow fadeIn animated mob-center">
                    <div class="row">
                        <div class="col-12 mb-20">
                            <div class="footer-bottom"></div>
                        </div>
                        <div class="col-lg-6">
                            <p class="float-md-left font-sm text-muted mb-0">
                                <a href="{{route('privacy')}}">Privacy Policy</a> | <a href="{{route('conditions')}}">terms-conditions.html">Terms &
                                    Conditions</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-lg-end text-start font-sm text-muted mb-0">
                                &copy; <strong class="text-brand">LocationObject</strong> All rights reserved
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            @livewireScripts
            <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
            <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
            <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
            <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/jquery-ui.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/perfect-scrollbar.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/images-loaded.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/isotope.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/jquery.vticker-min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js') }}"></script>
            <!-- Template  JS -->
            <script src="{{ asset('assets/js/main.js?v=3.3') }}"></script>
            <script src="{{ asset('assets/js/shop.js?v=3.3') }}"></script>
</body>
</html>