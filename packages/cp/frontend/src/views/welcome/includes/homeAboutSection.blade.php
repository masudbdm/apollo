@php
    $aboutMenu = collect($headerMenus ?? $footerMenus ?? [])->firstWhere('id', 7);
    $aboutLink = $aboutMenu?->link ?: ($aboutMenu ? route('page', ['id' => $aboutMenu->id, 'slug' => page_slug($aboutMenu->name)]) : url('/'));

    $pillCats = ($productCats ?? collect())->take(10);
    $pillSubCats = collect($pillCats)
        ->flatMap(fn ($c) => $c->activeSubCats ?? [])
        ->take(20);
@endphp

<section class="cp-home-about" style="background-image: url('{{ asset('/img/hd1.jpg') }}');">
    <div class="cp-home-about__overlay">
        <div class="container py-5">
            <div class="row align-items-center gy-4">
                <div class="col-12">
                    <div class="cp-home-about__top text-center">
                        <div class="cp-home-about__kicker">ABOUT US</div>
                        <div class="cp-home-about__line"></div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="counters counters-text-light counters-sm cp-home-about__counters">
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-3">
                                <div class="counter">
                                    <i class="icons icon-globe"></i>
                                    <strong data-to="80" data-append="+">80+</strong>
                                    <label>Exported Countries</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="counter">
                                    <i class="fas fa-users"></i>
                                    <strong data-to="1000000" data-append="+">1,000,000+</strong>
                                    <label>Serving Users</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mt-4 mt-md-0">
                                <div class="counter">
                                    <i class="icons icon-badge"></i>
                                    <strong data-to="18" data-append="+">18+</strong>
                                    <label>Industry Experience</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="cp-home-about__card">
                        <h3 class="cp-home-about__title mb-2">{{ $ws->website_title ?? 'Apollo Power Technology Co., Ltd.' }}</h3>
                        <div class="cp-home-about__text">
                            {{ \Illuminate\Support\Str::limit(strip_tags($ws->about_company ?? $ws->slogan ?? ''), 320) }}
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ $aboutLink }}" class="cp-home-about__more">MORE</a>
                        </div>

                        @if($pillCats->count() || $pillSubCats->count())
                            <hr class="cp-home-about__hr">
                            <div class="cp-home-about__pills-wrap">
                                <div class="cp-home-about__pills">
                                    @foreach($pillCats as $cat)
                                        <a class="cp-home-about__pill" href="{{ route('productCategory', ['cat' => $cat->id, 'slug' => $cat->slug ?? '']) }}">
                                            {{ $cat->name }}
                                        </a>
                                    @endforeach
                                    @foreach($pillSubCats as $subCat)
                                        <a class="cp-home-about__pill cp-home-about__pill--sub" href="{{ route('productSubCategory', ['subcat' => $subCat->id, 'slug' => $subCat->slug ?? '']) }}">
                                            {{ $subCat->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
