<div class="homepage-carousel-red-dots owl-carousel owl-theme nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark mb-0" data-plugin-options="{'items': 1, 'margin': 10, 'loop': true, 'nav': true, 'dots': true,'autoplay': true}">
    @foreach ($front_sliders as $slider)
        <div>
            <div class="img-thumbnail border-0 p-0 d-block">
                <a target="_blank" href="{{ $slider->link }}">
                    <img class="img-fluid border-radius-0" src="{{ route('imagecache', [ 'template'=>'original','filename' => $slider->fi() ]) }}" alt="">
                </a>
            </div>
        </div>
    @endforeach
</div>
@php
    $carouselIntroTitle = optional($ws)->carousel_intro_title;
    $carouselIntroText = optional($ws)->carousel_intro_text;
@endphp
@if(!empty(trim((string)($carouselIntroTitle ?? ''))) || !empty(trim((string)($carouselIntroText ?? ''))))
<div class="card w3-light-gray mb-3" style="margin-top: -28px !important;">
    <div class="card-body text-center">
        @if(!empty(trim((string)($carouselIntroTitle ?? ''))))
        <h4 class="text-color-1 text-sm-5  mb-0">{{ $carouselIntroTitle }}</h4>
        @endif
        @if(!empty(trim((string)($carouselIntroText ?? ''))))
        <p class="text-color-1  {{ !empty(trim((string)($carouselIntroTitle ?? ''))) ? 'mt-1 mb-0' : 'mb-0' }}">{{ $carouselIntroText }}</p>
        @endif
    </div>
</div>
@endif




