<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 70, 'stickyChangeLogo': false, 'stickyHeaderContainerHeight': 70}">
    <style>
        @media (max-width: 991.98px) {
            #header #mainNav > li > a.dropdown-item,
            #header #mainNav a.dropdown-item {
                color: #dc3545 !important;
            }

            #header .header-btn-collapse-nav {
                background: #dc3545 !important;
                background-color: #dc3545 !important;
                color: #fff !important;
                border-color: #dc3545 !important;
                box-shadow: none !important;
            }

            #header .header-btn-collapse-nav i {
                color: #fff !important;
            }

            #header .header-btn-collapse-nav:hover,
            #header .header-btn-collapse-nav:focus {
                background: #dc3545 !important;
                background-color: #dc3545 !important;
                color: #fff !important;
                border-color: #dc3545 !important;
                box-shadow: none !important;
            }

            #header .header-btn-collapse-nav:active,
            #header .header-btn-collapse-nav[aria-expanded="true"] {
                background: #dc3545 !important;
                background-color: #dc3545 !important;
                color: #fff !important;
                border-color: #dc3545 !important;
                box-shadow: none !important;
            }
        }
    </style>
    <div class="header-body border-top-0 box-shadow-none">
        <div class="header-top header-top-default border-bottom-0 cp-topbar-bright-white" style="background-color: #dc3545;">
            <div class="container">
                <div class="header-row py-2 flex-nowrap justify-content-between align-items-center">
                    <div class="header-column justify-content-start flex-grow-1 overflow-hidden">
                        <div class="header-row overflow-hidden">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills flex-nowrap w-100">
                                    <li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-sm-show">
                                        <span class="ws-nowrap text-light opacity-7 d-block text-truncate" style="max-width: 100%;">
                                            {{ $ws->slogan ?? '' }}
                                        </span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-column justify-content-end flex-shrink-0">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills text-uppercase text-2 flex-nowrap">
                                    @if(!empty($ws->contact_email))
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link ps-0 text-light opacity-7" href="mailto:{{ $ws->contact_email }}" aria-label="Email">
                                                <i class="far fa-envelope"></i>
                                                <span class="d-none d-md-inline"> {{ $ws->contact_email }}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @guest
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link text-light opacity-7 pe-0" href="{{ route('login') }}" aria-label="Login">
                                                <i class="fas fa-user"></i>
                                                <span class="d-none d-md-inline"> Login</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link text-light opacity-7 pe-0" href="{{ route('admin.dashboard') }}" aria-label="Account">
                                                <i class="fas fa-user"></i>
                                                <span class="d-none d-md-inline"> Account</span>
                                            </a>
                                        </li>
                                    @endguest
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container header-container-md container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                         @if(Agent::isMobile())
                            <div class="header-logo">
                            <a href="{{ url('/') }}"><img class="rounded" alt="{{ $ws->website_title }}" width="200" height="60" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}"></a>
                        </div>
                         @else
                            <div class="header-logo">
                                <a href="{{ url('/') }}"><img class="rounded" alt="{{ $ws->website_title }}" width="220" height="72" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}"></a>
                            </div>
                         @endif
                        
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-line header-nav-bottom-line header-nav-bottom-line-no-transform header-nav-bottom-line-active-text-dark header-nav-bottom-line-effect-1 order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">

                                        @if($homePage)
                                        <li class="dropdown">
                                            <a class="dropdown-item" href="{{ url('/') }}">
                                                {{ $homePage->name }}
                                            </a>
                                        </li>
                                        @endif

                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" style="cursor: pointer">
                                                Product
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach ($productCats as $cat)
                                                     <li class="dropdown-submenu">
                                                    <a class="dropdown-item" href="{{ route('productCategory',['cat' => $cat->id, 'slug' => $cat->slug ?? " "])}}">{{ $cat->name}}</a>
                                                    <ul class="dropdown-menu">

                                                    @foreach($cat->activeSubCats as $subCat)
                                                    <li><a class="dropdown-item" href="{{ route('productSubCategory', [ 'subcat' => $subCat->id, 'slug' => $subCat->slug ?? " " ])}}">{{ $subCat->name }}</a></li>
                                                    @endforeach
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>

                                     
                                        @foreach ($headerMenus as $menu)
                                        @if($menu->link)      
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" 
                                            href="{{ $menu->link }}">
                                                {{ $menu->name}}
                                            </a>
                                        </li>
                                        @else
                                          <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle">
                                                {{ $menu->name }}
                                            </a>

                                            <ul class="dropdown-menu">
                                                @if($menu->pages)
                                                @foreach ($menu->latestPages() as $page)
                                                @if($page->link)
                                                <li>
                                                    <a class="dropdown-item" href="{{ $page->link }}">{{ $page->name }}</a>
                                                </li>

                                                @else
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}">{{ $page->name }}</a>
                                                </li>
                                                @endif

                                                @endforeach
                                                @endif
                                            </ul>

                                        </li>
                                        @endif
                                        @endforeach


                                        @if(Auth::check())
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                {{ auth()->user()->name }}
                                            </a>
                                            

                                            <ul class="dropdown-menu">

                                                <li><a class="dropdown-item" href="{{ route('admin.dashboard')}}"> My Dashboard</a></li>
                                            
                                                <li>


                                                @if (Auth::user()->hasRole('admin'))
                                                     <li><a class="dropdown-item" href="{{ route('admin.dashboard')}}">Admin Dashboard</a></li>
                                            
                                           
                                                @endif
                                                <li>
                                                    <a href="javascript:void" class="dropdown-item" onclick="$('#logout-form').submit();">
                                                        Logout
                                                    </a>
                                                </li>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </li>
                                        @else
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="{{ route('login') }}">
                                                Login
                                            </a>
                                        </li>
                                        @endif

                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>

                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                            <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                <a href="#" class="header-nav-features-toggle text-decoration-none" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
                                <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed" id="headerTopSearchDropdown">
                                    <form role="search" action="{{ route('searchProduct') }}" method="get">
                                        @csrf
                                        <div class="simple-search input-group">
                                            <input class="form-control text-1" id="headerSearch" name="search" type="search" value="" placeholder="Search...">
                                            <button class="btn" type="submit">
                                                <i class="fas fa-search header-nav-top-icon text-color-dark"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                        {{-- Cart button hidden as requested --}}
                        {{--
                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2 me-2 me-lg-0">
                           @include('frontend::welcome.includes.headerCart')
                        </div>
                        --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    
</header>

