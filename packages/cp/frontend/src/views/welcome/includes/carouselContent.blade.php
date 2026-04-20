<div class="owl-carousel owl-theme nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark" data-plugin-options="{'items': 1, 'margin': 10, 'loop': true, 'nav': true, 'dots': true,'autoplay': true}">
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




