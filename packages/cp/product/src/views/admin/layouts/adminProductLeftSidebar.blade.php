  @php
    $u = auth()->user();
    $canProductCategoryShow = $u && $u->hasAnyPermission(['product-category-show']);
    $canProductSubCategoryShow = $u && $u->hasAnyPermission(['product-subcategory-show']);
    $canProductShow = $u && $u->hasAnyPermission(['product-show']);
    $canProductMenuShow = $u && $u->hasAnyPermission(['product-menu-show']);
    $canOrderMenuShow = $u && $u->hasAnyPermission(['order-menu-show']);
    $canOrderShow = $u && $u->hasAnyPermission(['order-show']);
  @endphp

  @if($canProductMenuShow)
  <li class="nav-item  {{ session('lsbm') == 'product' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-folder"></i>
      <p>
        Products
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @if($canProductCategoryShow)
        <li class="nav-item">
          <a href="{{ route('admin.productCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'productCategoriesAll' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Categories All</p>
          </a>
        </li>
      @endif
      @if($canProductSubCategoryShow)
        <li class="nav-item">
          <a href="{{ route('admin.productSubCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'productSubCategoriesAll' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>SubCategories All</p>
          </a>
        </li>
      @endif

      @if($canProductShow)
        <li class="nav-item">
          <a href="{{ route('admin.productsAll')}}" class="nav-link {{ session('lsbsm') == 'productsAll' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Products All</p>
          </a>
        </li>
      @endif
        
    </ul>
  </li>
  @endif


  @if($canOrderMenuShow)
    <li class="nav-item  {{ session('lsbm') == 'order' ? ' menu-open ' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas  fa-folder"></i>
        <p>
          Order
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @if($canOrderShow)
          <li class="nav-item">
            <a href="{{ route('admin.orderList')}}" class="nav-link {{ session('lsbsm') == 'orderList' ? ' active ' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Order List</p>
            </a>
          </li>
        @endif
      </ul>
    </li>
  @endif