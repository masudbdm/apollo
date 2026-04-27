@extends('frontend::layouts.frontendMaster')
@section('title', $product->name . ' | ' . $ws->website_title)


@section('content')
@php
    $hasPrice = !blank($product->price) && floatval($product->price) > 0;
    $primaryCategory = $product->productCategories->first();
    $downloadFiles = $product->files ?? collect();
@endphp

<div role="main" class="main shop cp-single-product-page cp-product-listing-page">
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md mb-0 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb breadcrumb-style-2 d-flex justify-content-center flex-wrap mb-2 pb-0">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        @if($primaryCategory)
                            <li><a href="{{ route('productCategory', ['cat' => $primaryCategory->id, 'slug' => $primaryCategory->slug ?? '']) }}">{{ $primaryCategory->name }}</a></li>
                        @endif
                        <li class="active">{{ $product->name }}</li>
                    </ul>
                </div>
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-7 mb-0">{{ $product->name }}</h1>
                    @if(!empty(trim(strip_tags($product->excerpt ?? ''))))
                        <span class="sub-title text-dark d-block mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($product->excerpt), 220) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4 py-lg-5">
        <div class="row g-4 align-items-start">
            <div class="col-lg-6">
                <div class="cp-single-product__gallery card border-0 shadow-sm rounded overflow-hidden bg-white">
                    <div class="thumb-gallery-wrapper cp-zoom-thumb-gallery">
                        <div class="thumb-gallery-detail owl-carousel owl-theme manual nav-inside nav-style-1 nav-dark mb-3">
                            <div>
                                <img alt="{{ $product->name }}" class="img-fluid cp-zoom-main-img"
                                    src="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}"
                                    data-zoom-src="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}">
                            </div>
                            @foreach($product->activeProductImages() as $image)
                                <div>
                                    <img alt="{{ $product->name }}" class="img-fluid cp-zoom-main-img"
                                        src="{{ route('imagecache', ['template' => 'original', 'filename' => $image->fi()]) }}"
                                        data-zoom-src="{{ route('imagecache', ['template' => 'original', 'filename' => $image->fi()]) }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs px-2 pb-2">
                            <div class="cur-pointer">
                                <img alt="" class="img-fluid rounded" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $product->fi()]) }}">
                            </div>
                            @foreach($product->activeProductImages() as $image)
                                <div class="cur-pointer">
                                    <img alt="" class="img-fluid rounded" src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $image->fi()]) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="cp-single-product__summary ps-lg-2">
                    <div class="divider divider-small mt-2 mb-3">
                        <hr class="bg-color-grey-scale-4">
                    </div>

                    @if($hasPrice)
                        <p class="price mb-4">
                            <span class="amount text-color-primary font-weight-bold text-8">Tk. {{ number_format((float) $product->price, 2) }}</span>
                        </p>
                    @else
                        <div class="alert alert-light border cp-single-product__contact-alert mb-4">
                            <div class="font-weight-bold text-4 mb-2 text-dark">Contact for pricing</div>
                            @if($ws && !empty($ws->contact_mobile))
                                <div class="mb-1 text-3">
                                    <i class="fas fa-phone-alt text-color-primary me-2"></i>
                                    <a class="text-decoration-none text-dark" href="tel:{{ preg_replace('/\s+/', '', $ws->contact_mobile) }}">{{ $ws->contact_mobile }}</a>
                                </div>
                            @endif
                            @if($ws && !empty($ws->contact_email))
                                <div class="text-3">
                                    <i class="far fa-envelope text-color-primary me-2"></i>
                                    <a class="text-decoration-none text-dark" href="mailto:{{ $ws->contact_email }}">{{ $ws->contact_email }}</a>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="d-flex align-items-center flex-wrap gap-2 mb-0">
                        @if($ws && !empty($ws->fb_url))
                            <a href="{{ $ws->fb_url }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-dark rounded-pill px-3"><i class="fab fa-facebook-f me-1"></i> Share</a>
                        @endif
                        @if($ws && !empty($ws->contact_email))
                            <a href="mailto:{{ $ws->contact_email }}?subject={{ rawurlencode($product->name ?? '') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="far fa-envelope me-1"></i> Email</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="cp-single-product__tabs card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div id="productTabs" class="tabs tabs-simple tabs-simple-full-width-line tabs-product tabs-dark mb-0">
                            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded justify-content-start flex-wrap bg-color-grey-scale-1 px-3 pt-3 mb-0">
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-bold text-3 text-uppercase py-3 px-4" href="#productDescription" data-bs-toggle="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold text-3 text-uppercase py-3 px-4" href="#productInfo" data-bs-toggle="tab">Additional Information</a>
                                </li>
                                @if($downloadFiles->isNotEmpty())
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold text-3 text-uppercase py-3 px-4" href="#productDownloads" data-bs-toggle="tab">
                                            Downloads <span class="badge bg-primary ms-1">{{ $downloadFiles->count() }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content p-4 p-lg-5">
                                <div class="tab-pane fade show active" id="productDescription">
                                    <div class="text-3-5 line-height-7 text-color-dark">
                                        {!! $product->description ?: '<p class="text-muted mb-0">No description provided.</p>' !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="productInfo">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="w-25 bg-light">Name</th>
                                                    <td>{{ $product->name }}</td>
                                                </tr>
                                                @if($hasPrice)
                                                    <tr>
                                                        <th class="bg-light">Price</th>
                                                        <td>Tk. {{ number_format((float) $product->price, 2) }}</td>
                                                    </tr>
                                                @endif
                                                @if($product->productCategories->isNotEmpty())
                                                    <tr>
                                                        <th class="bg-light">Categories</th>
                                                        <td>{{ $product->productCategories->pluck('name')->filter()->implode(', ') }}</td>
                                                    </tr>
                                                @endif
                                                @if(!empty(trim(strip_tags($product->excerpt ?? ''))))
                                                    <tr>
                                                        <th class="bg-light">Summary</th>
                                                        <td>{{ strip_tags($product->excerpt) }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if($downloadFiles->isNotEmpty())
                                    <div class="tab-pane fade" id="productDownloads">
                                        <p class="text-muted mb-4">Download brochures, manuals, and technical files. PDF and image files can be previewed below.</p>
                                        <div class="list-group list-group-flush rounded border mb-4">
                                            @foreach($downloadFiles as $file)
                                                @php
                                                    $url = $file->publicUrl();
                                                    $kind = $file->previewKind();
                                                @endphp
                                                <div class="list-group-item list-group-item-action d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 py-3">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <span class="rounded-circle bg-color-grey-scale-1 d-flex align-items-center justify-content-center cp-single-product__file-icon">
                                                            @if($file->isPdf())
                                                                <i class="far fa-file-pdf text-danger text-5"></i>
                                                            @elseif($file->isImage())
                                                                <i class="far fa-file-image text-primary text-5"></i>
                                                            @else
                                                                <i class="far fa-file-alt text-secondary text-5"></i>
                                                            @endif
                                                        </span>
                                                        <div>
                                                            <div class="font-weight-bold text-dark text-3">{{ $file->displayName() }}</div>
                                                            <div class="text-2 text-muted text-uppercase">{{ $file->extension() ?: 'file' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @if($file->canEmbedPreview())
                                                            <button type="button" class="btn btn-sm btn-outline-primary cp-preview-file-btn"
                                                                data-url="{{ $url }}"
                                                                data-kind="{{ $kind }}"
                                                                data-title="{{ $file->displayName() }}">
                                                                <i class="far fa-eye me-1"></i> Preview
                                                            </button>
                                                        @endif
                                                        <a href="{{ $url }}" class="btn btn-sm btn-primary" download target="_blank" rel="noopener">
                                                            <i class="fas fa-download me-1"></i> Download
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div id="cp-file-preview-panel" class="cp-file-preview-panel border rounded bg-white shadow-sm d-none">
                                            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-color-grey-scale-1">
                                                <h4 class="mb-0 text-4 text-dark" id="cp-file-preview-title">Preview</h4>
                                                <button type="button" class="btn-close" id="cp-file-preview-close" aria-label="Close preview"></button>
                                            </div>
                                            <div class="p-2 p-md-3 bg-light">
                                                <iframe id="cp-file-preview-iframe" title="Document preview" class="w-100 rounded shadow-sm d-none bg-white" style="min-height: 520px; border: 0;"></iframe>
                                                <div id="cp-file-preview-img-wrap" class="text-center d-none">
                                                    <img id="cp-file-preview-img" src="" alt="" class="img-fluid rounded shadow-sm border bg-white p-2" style="max-height: 720px;">
                                                </div>
                                                <p id="cp-file-preview-hint" class="text-muted text-center mb-0 py-5 d-none small">Preview is not available for this file type. Use Download instead.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
            <div class="row mt-5 pt-3">
                <div class="col-12">
                    <h4 class="font-weight-bold text-6 mb-3 text-dark">Related products</h4>
                    <hr class="mt-0 mb-4">
                    <div class="owl-carousel owl-theme nav-style-1 nav-outside nav-dark mb-0"
                        data-plugin-options="{'loop': false, 'autoplay': false, 'items': 4, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'responsive': {'0': {'items': 1}, '576': {'items': 2}, '992': {'items': 3}, '1200': {'items': 4}}}">
                        @foreach($relatedProducts as $rel)
                            <div class="product mb-0">
                                <div class="product-thumb-info border-0 mb-3">
                                    <a href="{{ route('singleProduct', ['product' => $rel->id, 'slug' => $rel->slug ?? '']) }}">
                                        <div class="product-thumb-info-image rounded overflow-hidden border">
                                            <img alt="{{ $rel->name }}" class="img-fluid" src="{{ route('imagecache', ['template' => 'ppxlg', 'filename' => $rel->fi()]) }}">
                                        </div>
                                    </a>
                                </div>
                                <div class="text-center px-1">
                                    <h3 class="text-4 font-weight-semibold line-height-3 mb-1">
                                        <a href="{{ route('singleProduct', ['product' => $rel->id, 'slug' => $rel->slug ?? '']) }}" class="text-dark text-decoration-none">{{ $rel->name }}</a>
                                    </h3>
                                    @if(!blank($rel->price) && floatval($rel->price) > 0)
                                        <span class="text-color-dark text-3 font-weight-semibold">Tk. {{ number_format((float) $rel->price, 2) }}</span>
                                    @else
                                        <span class="text-muted text-3">Contact us</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('css')
<style>
.cp-single-product__gallery .thumb-gallery-thumbs img {
    border: 2px solid transparent;
    opacity: 0.85;
    transition: opacity 0.2s, border-color 0.2s;
}
.cp-single-product__gallery .thumb-gallery-thumbs .owl-item.synced img,
.cp-single-product__gallery .thumb-gallery-thumbs .cur-pointer:hover img {
    opacity: 1;
    border-color: var(--primary, #dc3545);
}
.cp-single-product__file-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
}
.cp-single-product__tabs .nav-tabs .nav-link {
    border: none;
    border-radius: 0.35rem 0.35rem 0 0;
}
.cp-single-product__tabs .nav-tabs .nav-link.active {
    background: #fff;
    color: var(--primary, #dc3545) !important;
    box-shadow: 0 -2px 0 var(--primary, #dc3545) inset;
}
.cp-file-preview-panel {
    overflow: hidden;
}
.cp-single-product__gallery .thumb-gallery-detail .owl-item img.cp-zoom-main-img {
    position: relative;
    cursor: crosshair;
}
.cp-single-product__gallery .thumb-gallery-detail .owl-stage-outer {
    overflow: hidden;
}
@media (max-width: 767px) {
    .cp-single-product-page .page-header h1 {
        font-size: 1.75rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('/frontend/vendor/elevatezoom/jquery.elevatezoom.min.js') }}"></script>
<script src="{{ asset('/frontend/js/examples/examples.gallery.js') }}"></script>
<script>
(function ($) {
    'use strict';

    /**
     * elevateZoom must bind AFTER Owl Carousel is ready, and re-bind on slide change.
     * We use data-zoom-src (not data-zoom-image) so theme view.shop.js skips auto-init on these imgs.
     */
    $(function () {
        var $wrap = $('.cp-zoom-thumb-gallery');
        if (!$wrap.length || typeof $.fn.elevateZoom !== 'function') {
            return;
        }

        var $detail = $wrap.find('.thumb-gallery-detail');

        function cleanupZoom() {
            $('.zoomContainer').remove();
            $('.zoomWindowContainer').remove();
            $('.zoomLens').remove();
            $('.zoomPad').remove();
            $('.zoomWrapper').remove();
            $wrap.find('img.cp-zoom-main-img').each(function () {
                var $img = $(this);
                var ez = $img.data('elevateZoom');
                if (ez && typeof ez.destroy === 'function') {
                    try { ez.destroy(); } catch (e) {}
                }
                $img.removeData('elevateZoom');
            });
        }

        function bindActiveZoom() {
            cleanupZoom();

            var $active = $detail.find('.owl-item.active').first();
            if (!$active.length) {
                return;
            }

            var $img = $active.find('img.cp-zoom-main-img[data-zoom-src]').first();
            if (!$img.length) {
                return;
            }

            var hiRes = $img.attr('data-zoom-src') || $img.attr('src');
            if (!hiRes) {
                return;
            }

            /* Plugin reads large image from data-zoom-image */
            $img.attr('data-zoom-image', hiRes);

            $img.elevateZoom({
                responsive: true,
                zoomType: 'inner',
                cursor: 'crosshair',
                borderSize: 0,
                zoomWindowFadeIn: 200,
                zoomWindowFadeOut: 100,
                scrollZoom: true,
                easing: true
            });
        }

        function waitGalleryThenBind() {
            var tries = 0;
            var id = window.setInterval(function () {
                tries++;
                if ($detail.hasClass('owl-loaded') || tries > 80) {
                    window.clearInterval(id);
                    bindActiveZoom();
                    $detail.off('.cpZoomBind').on('changed.owl.carousel.cpZoomBind translated.owl.carousel.cpZoomBind refreshed.owl.carousel.cpZoomBind', function () {
                        window.requestAnimationFrame(function () {
                            bindActiveZoom();
                        });
                    });
                }
            }, 50);
        }

        waitGalleryThenBind();
    });
})(jQuery);
</script>
<script>
(function () {
    var panel = document.getElementById('cp-file-preview-panel');
    if (!panel) return;

    var iframe = document.getElementById('cp-file-preview-iframe');
    var imgWrap = document.getElementById('cp-file-preview-img-wrap');
    var img = document.getElementById('cp-file-preview-img');
    var titleEl = document.getElementById('cp-file-preview-title');
    var hint = document.getElementById('cp-file-preview-hint');
    var closeBtn = document.getElementById('cp-file-preview-close');

    function hideAll() {
        iframe.classList.add('d-none');
        iframe.src = 'about:blank';
        imgWrap.classList.add('d-none');
        img.removeAttribute('src');
        hint.classList.add('d-none');
    }

    function openPreview(url, kind, name) {
        hideAll();
        titleEl.textContent = name || 'Preview';
        panel.classList.remove('d-none');

        if (kind === 'pdf') {
            iframe.classList.remove('d-none');
            iframe.src = url;
        } else if (kind === 'image') {
            imgWrap.classList.remove('d-none');
            img.alt = name || '';
            img.src = url;
        } else {
            hint.classList.remove('d-none');
        }

        panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    document.querySelectorAll('.cp-preview-file-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openPreview(this.getAttribute('data-url'), this.getAttribute('data-kind'), this.getAttribute('data-title'));
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            panel.classList.add('d-none');
            hideAll();
        });
    }
})();
</script>
@endpush
