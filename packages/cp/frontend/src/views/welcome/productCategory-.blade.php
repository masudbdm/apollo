@extends('frontend::layouts.frontendMaster')
@section('title',$ws->website_title)


@section('content') 
    <div role="main" class="main shop">
        <section class="container-fluid pb-1">
            <span class="p-0 m-0"> <a class="text-black" href="{{ url('/')}}"><i class="fa fa-home "></i></a> >> 
            <a class="text-black" href="{{ route('productCategory',['cat' => $cat->id, 'slug' => $cat->slug ?? " "])}}">
                {{ $cat->name }}
            </a></span>
            <div class="row">
                <div class="col-lg-12">
                <div class="nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark">
                        <div>
                            <div class="img-thumbnail border-0 p-0 d-block">
                                <a target="_blank" href="">
                                    <img class="img-fluid border-radius-0" src="{{ route('imagecache', [ 'template'=>'original','filename' => $cat->fi() ]) }}" alt="">
                                </a>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
    
        </section>

      

        @if($cat->activeSubCats()->count() > 1)
        <section class="container-fluid pt-3">
            <div class="row">
                <div class="col-lg-12 carousel-container">
                    <div class="owl-carousel owl-theme nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark" data-plugin-options="{'items': 1, 'margin': 10, 'loop': true, 'nav': true, 'dots': true,'autoplay': true}">
                    @foreach ($cat->activeSubCats as $subcat)
                       
                        <div>
                            <div class="img-thumbnail border-0 p-0 d-block">
                                <a target="_blank" href="">
                                    <img style="height: 500px" class="img-fluid border-radius-0" src="{{ route('imagecache', [ 'template'=>'original','filename' => $subcat->fi() ]) }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </section>
        @endif

         @foreach ($cat->activeSubCats as $subcat)
            <section class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="nav-inside nav-inside-edge nav-squared nav-with-transparency nav-dark">
                            <div>
                                <div class="img-thumbnail border-0 p-0 d-block">
                                    <a target="_blank" href="">
                                        <img class="img-fluid border-radius-0" src="{{ route('imagecache', [ 'template'=>'original','filename' => $subcat->fi() ]) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </section>

            {{-- product section --}}
              
            <div class="container-fluid pt-3">
                <div class="masonry-loader masonry-loader-showing">
                    <div class="row products product-thumb-info-list" data-plugin-masonry data-plugin-options="{'layoutMode': 'fitRows'}">
                    <div class="row">
                        @foreach($subcat->products->take(4) as $product)
                        <div class="col-12 col-sm-6 col-lg-3">
                                <div class="product mb-0">
                                    <div class="product-thumb-info border-0 mb-3">
                                        <div class="addtocart-btn-wrapper">
                                            <a href="{{ route('singleProduct',[ 'product' => $product->id, 'slug' => $product->slug ?? " " ])}}" class="text-decoration-none addtocart-btn" title="Add to Cart">
                                                <i class="icons icon-bag"></i>
                                            </a>
                                        </div>

                                        <a href="{{route('productQuickView',$product)}}" class="quick-view text-uppercase font-weight-semibold text-2">
                                            QUICK VIEW
                                        </a>
                                       
                                        <a href="{{ route('singleProduct',['product' => $product->id, 'slug' => $product->slug ?? " " ])}}">
                                            <div class="product-thumb-info-image">
                                                <img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'ppxlg','filename' => $product->fi() ]) }}">

                                            </div>
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <div>
                                            <h3 class="text-5 font-weight-medium text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">{{ $product->name}}</a></h3>
                                                <span class="sale text-color-dark text-4 font-weight-semi-bold">Tk.{{$product->price}}</span>
                                            </p>
                                        </div>

                                        
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                    
                    </div>
                </div>
                    <a href="{{ route('productSubCategory',['subcat' => $subcat->id, 'slug' => $subcat->slug])}}" class="btn btn-dark w-100 mb-2 text-4">See More</a>
            </div> 

       
        {{-- product section --}}
            
         @endforeach


       


    </div>
@endsection

@push('scripts')
   <script src="{{asset("/frontend/js/examples/examples.gallery.js")}}"></script>	
   <script src="{{asset("/frontend/vendor/jquery.countdown/jquery.countdown.min.js")}}"></script>
   <script src="{{asset("/frontend/vendor/elevatezoom/jquery.elevatezoom.min.js")}}"></script> 
@endpush






