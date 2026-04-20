<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 70, 'stickyChangeLogo': false, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0 box-shadow-none">
        <div class="header-container header-container-md container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                         @if(Agent::isMobile())
                            <div class="header-logo">
                            <a href="{{ url('/') }}"><img class="rounded" alt="Matson" width="200" height="60" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}"></a>
                        </div>
                         @else
                            <div class="header-logo">
                                <a href="{{ url('/') }}"><img class="rounded" alt="Matson" width="260" height="72" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}"></a>
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

                        
                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2 me-2 me-lg-0">
                           @include('frontend::welcome.includes.headerCart')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
</header>

