@extends('admin::layouts.adminMaster')
@section('title')
    | Admin Dashboard
@endsection

@push('css')
<style>
  .quick-links-grid{
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 16px;
  }

  .quick-card{
    grid-column: span 12;
    position: relative;
    display: block;
    border-radius: 16px;
    padding: 18px 18px;
    color: #111827;
    text-decoration: none !important;
    overflow: hidden;
    background: rgba(255,255,255,0.62);
    border: 1px solid rgba(255,255,255,0.55);
    box-shadow:
      0 10px 30px rgba(0,0,0,0.08),
      inset 0 1px 0 rgba(255,255,255,0.65);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transform: translateZ(0);
    transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
  }

  .quick-card::before{
    content: "";
    position: absolute;
    inset: -80px;
    background: radial-gradient(closest-side, rgba(59,130,246,0.18), transparent 65%),
                radial-gradient(closest-side, rgba(168,85,247,0.14), transparent 65%),
                radial-gradient(closest-side, rgba(34,197,94,0.12), transparent 65%);
    animation: glazeFloat 9s ease-in-out infinite;
    pointer-events: none;
  }

  .quick-card::after{
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.55) 45%, transparent 70%);
    transform: translateX(-120%);
    animation: glazeShine 3.8s ease-in-out infinite;
    pointer-events: none;
    opacity: .65;
  }

  .quick-card:hover{
    transform: translateY(-3px);
    border-color: rgba(255,255,255,0.85);
    box-shadow:
      0 16px 38px rgba(0,0,0,0.12),
      inset 0 1px 0 rgba(255,255,255,0.75);
  }

  .quick-card .qc-top{
    position: relative;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
  }
  .quick-card .qc-icon{
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(17,24,39,0.06);
    color: #111827;
    flex: 0 0 auto;
  }
  .quick-card .qc-title{
    font-weight: 700;
    font-size: 16px;
    margin: 0;
    line-height: 1.25;
  }
  .quick-card .qc-sub{
    position: relative;
    margin: 6px 0 0;
    color: rgba(17,24,39,0.7);
    font-size: 13px;
    line-height: 1.4;
  }
  .quick-card .qc-arrow{
    opacity: .65;
    margin-left: auto;
    flex: 0 0 auto;
  }

  @keyframes glazeShine{
    0%, 45% { transform: translateX(-120%); }
    65% { transform: translateX(120%); }
    100% { transform: translateX(120%); }
  }
  @keyframes glazeFloat{
    0%   { transform: translate3d(-10px, -6px, 0) scale(1); }
    50%  { transform: translate3d(18px, 10px, 0) scale(1.04); }
    100% { transform: translate3d(-10px, -6px, 0) scale(1); }
  }

  @media (min-width: 768px){
    .quick-card{ grid-column: span 6; }
  }
  @media (min-width: 1200px){
    .quick-card{ grid-column: span 4; }
  }
</style>
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @php
        $user = auth()->user();
        $can = function (string $permission) use ($user): bool {
          return $user && method_exists($user, 'hasAnyPermission')
            ? $user->hasAnyPermission([$permission])
            : false;
        };

        $cards = [
          [
            'title' => 'Users',
            'subtitle' => 'Manage users & access',
            'route' => 'admin.usersAll',
            'icon' => 'fas fa-users',
            'permission' => 'user-show',
          ],
          [
            'title' => 'Product Categories',
            'subtitle' => 'Create & organize categories',
            'route' => 'admin.productCategoriesAll',
            'icon' => 'fas fa-tags',
            'permission' => 'product-category-show',
          ],
          [
            'title' => 'Product Subcategories',
            'subtitle' => 'Create & organize subcategories',
            'route' => 'admin.productSubCategoriesAll',
            'icon' => 'fas fa-layer-group',
            'permission' => 'product-subcategory-show',
          ],
          [
            'title' => 'Products',
            'subtitle' => 'All products list',
            'route' => 'admin.productsAll',
            'icon' => 'fas fa-box-open',
            'permission' => 'product-show',
          ],
          [
            'title' => 'Orders',
            'subtitle' => 'View & manage orders',
            'route' => 'admin.orderList',
            'icon' => 'fas fa-receipt',
            'permission' => 'order-show',
          ],
          [
            'title' => 'Contact Messages',
            'subtitle' => 'Website contact inbox',
            'route' => 'admin.contactMessages.index',
            'icon' => 'far fa-envelope',
            'permission' => 'contact-message-show',
          ],
          [
            'title' => 'Website Settings',
            'subtitle' => 'Contact, logo, social links',
            'route' => 'admin.websitesetting',
            'icon' => 'fas fa-cog',
            'permission' => 'website-setting-show',
          ],
          [
            'title' => 'Media Library',
            'subtitle' => 'Upload & manage media',
            'route' => 'admin.mediasAll',
            'icon' => 'far fa-images',
            'permission' => 'media-show',
          ],
          [
            'title' => 'Blog Categories',
            'subtitle' => 'Manage blog categories',
            'route' => 'admin.blogCategoriesAll',
            'icon' => 'fas fa-folder-open',
            'permission' => 'post-category-show',
          ],
          [
            'title' => 'Blog Posts',
            'subtitle' => 'Manage blog posts',
            'route' => 'admin.blogPostsAll',
            'icon' => 'far fa-newspaper',
            'permission' => 'post-show',
          ],
          [
            'title' => 'Front Sliders',
            'subtitle' => 'Homepage sliders',
            'route' => 'admin.slidersAll',
            'icon' => 'fas fa-sliders-h',
            'permission' => 'front-slider-show',
          ],
          [
            'title' => 'Menus',
            'subtitle' => 'Header/footer menus',
            'route' => 'admin.menusAll',
            'icon' => 'fas fa-bars',
            'permission' => 'menu-show',
          ],
          [
            'title' => 'Pages',
            'subtitle' => 'Static pages & content',
            'route' => 'admin.pagesAll',
            'icon' => 'far fa-file-alt',
            'permission' => 'page-show',
          ],
        ];
      @endphp

      <div class="card">
        <div class="card-body">
          <div class="quick-links-grid">
            @foreach($cards as $c)
              @if(\Illuminate\Support\Facades\Route::has($c['route']) && (!isset($c['permission']) || $can($c['permission'])))
                <a class="quick-card" href="{{ route($c['route']) }}">
                  <div class="qc-top">
                    <div class="qc-icon">
                      <i class="{{ $c['icon'] }}"></i>
                    </div>
                    <div>
                      <p class="qc-title mb-0">{{ $c['title'] }}</p>
                      <p class="qc-sub mb-0">{{ $c['subtitle'] }}</p>
                    </div>
                    <div class="qc-arrow">
                      <i class="fas fa-arrow-right"></i>
                    </div>
                  </div>
                </a>
              @endif
            @endforeach
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
