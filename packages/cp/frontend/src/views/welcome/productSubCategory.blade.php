@extends('frontend::layouts.frontendMaster')
@section('title', $subcat->name . ' | ' . $ws->website_title)


@section('content')
<div role="main" class="main shop cp-product-listing-page">
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md mb-0 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8">{{ $subcat->name }}</h1>
                    @if(!empty(trim(strip_tags($subcat->excerpt ?? ''))))
                        <span class="sub-title text-dark d-block mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($subcat->excerpt), 160) }}</span>
                    @elseif($cat && !empty(trim(strip_tags($cat->excerpt ?? ''))))
                        <span class="sub-title text-dark d-block mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($cat->excerpt), 160) }}</span>
                    @else
                        <span class="sub-title text-dark">Browse products in this subcategory</span>
                    @endif
                </div>
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block text-center">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        @if($cat)
                            <li><a href="{{ route('productCategory', ['cat' => $cat->id, 'slug' => $cat->slug ?? '']) }}">{{ $cat->name }}</a></li>
                        @endif
                        <li class="active">{{ $subcat->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if($subcat->fi() && $subcat->fi() !== 'not_found.jpg')
        <div class="container-fluid px-0">
            <div class="img-thumbnail border-0 p-0 d-block rounded-0">
                <img class="img-fluid w-100 border-radius-0" src="{{ route('imagecache', ['template' => 'original', 'filename' => $subcat->fi()]) }}" alt="{{ $subcat->name }}">
            </div>
        </div>
    @endif

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1 mb-5 mb-lg-0">
                <aside class="sidebar">
                    <form action="{{ route('searchProduct') }}" method="get">
                        <div class="input-group mb-3 pb-1">
                            <input class="form-control text-1" placeholder="Search products…" name="search" id="productSubCatSearch" type="text" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-dark text-1 p-2" aria-label="Search"><i class="fas fa-search m-2"></i></button>
                        </div>
                    </form>

                    @if($cat)
                    <h5 class="font-weight-semi-bold pt-2">Subcategories</h5>
                    <ul class="nav nav-list flex-column mb-4 mb-lg-5">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productCategory', ['cat' => $cat->id, 'slug' => $cat->slug ?? '']) }}">All — {{ $cat->name }}</a>
                        </li>
                        @foreach ($subcats as $item)
                            <li class="nav-item">
                                <a class="nav-link {{ $item->id === $subcat->id ? 'active' : '' }}" href="{{ route('productSubCategory', ['subcat' => $item->id, 'slug' => $item->slug ?? '']) }}">
                                    {{ $item->name }}
                                    @if(isset($item->products_count))
                                        <span class="text-muted">({{ $item->products_count }})</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </aside>
            </div>

            <div class="col-lg-9 order-1 order-lg-2">
                <div class="cp-category-products-panel">
                    <div class="blog-posts blog-posts-no-margins mb-0">
                    @forelse ($products as $product)
                        <article class="cp-category-product-card post post-medium">
                            <div class="row align-items-lg-center g-0">
                                <div class="col-lg-5">
                                    <div class="post-image mb-3 mb-lg-0 pe-lg-3">
                                        <a href="{{ route('singleProduct', ['product' => $product->id, 'slug' => $product->slug ?? '']) }}" class="d-block">
                                            <img src="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $product->fi()]) }}" class="img-fluid w-100 cp-category-product-card__img" alt="{{ $product->name }}" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="post-content ps-lg-2">
                                        <h2 class="font-weight-bold text-dark pt-2 pt-lg-0 text-5 line-height-4 mb-3">
                                            <a href="{{ route('singleProduct', ['product' => $product->id, 'slug' => $product->slug ?? '']) }}" class="text-dark text-decoration-none">{{ $product->name }}</a>
                                        </h2>
                                        <p class="cp-category-product-card__excerpt text-3 line-height-5 mb-3">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 280) }}
                                        </p>
                                        <div class="d-flex flex-wrap align-items-center">
                                            @if((float) ($product->price ?? 0) > 0)
                                            <span class="text-3 me-4 mb-2 mb-sm-0"><i class="fas fa-tag me-1"></i><strong class="text-color-primary">Tk. {{ number_format((float) $product->price, 2) }}</strong></span>
                                            @endif
                                            <a href="{{ route('singleProduct', ['product' => $product->id, 'slug' => $product->slug ?? '']) }}" class="btn btn-sm btn-light border text-color-dark text-2 text-uppercase px-4 py-2">More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="text-center text-muted py-5 mb-0">No products in this subcategory yet.</p>
                    @endforelse
                    </div>
                </div>

                @if($products->hasPages())
                    <div class="row mt-4 cp-category-pagination">
                        <div class="col d-flex justify-content-center">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.cp-category-products-panel {
    background-color: #f5f6f8;
    border-radius: 2px;
    padding: 1.25rem;
}
@media (min-width: 992px) {
    .cp-category-products-panel {
        padding: 1.5rem;
    }
}
.cp-category-products-panel .blog-posts article.cp-category-product-card {
    margin-bottom: 0.65rem !important;
    padding-bottom: 0 !important;
    border-bottom: none !important;
}
.cp-category-product-card {
    background: #fff;
    border: 1px solid #e1e4e8;
    padding: 1.25rem 1.25rem;
    transition: box-shadow 0.28s ease, transform 0.28s ease;
}
.cp-category-products-panel .blog-posts article.cp-category-product-card:last-child {
    margin-bottom: 0 !important;
}
.cp-category-product-card:hover {
    box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
    transform: translateY(-4px);
}
.cp-category-product-card__img {
    display: block;
    border: 1px solid #eceef1;
}
.cp-category-product-card__excerpt {
    color: #5c656f;
}
.cp-category-pagination .pagination .page-link {
    color: #dc3545 !important;
    background-color: #fff !important;
    border-color: #f0b0b7 !important;
}
.cp-category-pagination .pagination a.page-link:hover {
    color: #fff !important;
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
.cp-category-pagination .pagination .page-item.active .page-link,
.cp-category-pagination .pagination .page-item.active span.page-link {
    color: #fff !important;
    background-color: #dc3545 !important;
    border-color: #c82333 !important;
    background-image: none !important;
    box-shadow: none !important;
}
.cp-category-pagination .pagination .page-item.disabled .page-link {
    color: rgba(200, 35, 51, 0.5) !important;
    background-color: #f8f9fa !important;
    border-color: #f0b0b7 !important;
}
</style>
@endpush
