@extends('frontend::layouts.frontendMaster')
@section('title',$ws->website_title)


@section('content') 
    <div role="main" class="main shop">
         <section class="container-fluid">
            <span class="p-0 m-0"> <a class="text-black" href="{{ url('/')}}"><i class="fa fa-home "></i></a> >> 
            <a class="text-black" href="{{ route('productCategory',['cat' => $subcat->productCategory->id, 'slug' => $subcat->productCategory->slug])}}">
               {{ $subcat->productCategory->name }}
            </a>
           </a> >> 
            <a class="text-black" href="{{ route('productSubCategory',['cat' =>  $subcat->productCategory->slug, 'subcat' => $subcat->id, 'slug'=> $subcat->slug])}}">
               {{ $subcat->name }}
            </a>
          </span>
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


        <div class="container-fluid pt-3">
            <div class="masonry-loader masonry-loader-showing">
                <div class="row products product-thumb-info-list" data-plugin-masonry data-plugin-options="{'layoutMode': 'fitRows'}">
                <div class="row">
                    @foreach($subcat->products as $product)
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
                                    <a href="{{ route('singleProduct',[ 'product' => $product->id ,'slug' => $product->slug ?? " " ])}}">
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
        </div> 

    </div>
@endsection

@push('scripts')
   <script src="{{asset("/frontend/js/examples/examples.gallery.js")}}"></script>	
   <script src="{{asset("/frontend/vendor/jquery.countdown/jquery.countdown.min.js")}}"></script>
   <script src="{{asset("/frontend/vendor/elevatezoom/jquery.elevatezoom.min.js")}}"></script> 
@endpush




