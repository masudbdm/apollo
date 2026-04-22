@extends('frontend::layouts.frontendMaster')
@section('title',$ws->website_title)


@section('content') 

<div role="main" class="main lazy-load" data-url="{{route('lazyloadContent')}}">
    <section class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-lg-12 carousel-container p-0 m-0">
                <div class="box box-widget mb-3 w3-animate-zoom p-0 m-0">
                    <div class="box-body" style="min-height: 150px;text-align: center;">
                        <i class="fa fa-spinner w3-jumbo w3-text-light-gray fa-spin" style="margin-top: 50px;"></i>        
                    </div>
                </div> 

            </div>
         </div>
    </section>


    <section class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-lg-12 homepage-container">
                <div class="box box-widget mb-3 w3-animate-zoom">
                    <div class="box-body" style="min-height: 150px;text-align: center;">
                        <i class="fa fa-spinner w3-jumbo w3-text-light-gray fa-spin" style="margin-top: 50px;"></i>        
                    </div>
                </div> 
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')


    <script>
    $(document).ready(function(){


    function loadajax(){
      var url = $('.lazy-load').attr('data-url');
      $.ajax({ 
        url: url,
        type:"get",
        success:function(response){

            $('.carousel-container').empty().append(response.carouselContainer);
            
            $('.homepage-container').empty().append(response.homepageContainer);

            // Re-init theme plugins for AJAX-injected markup (e.g. counters)
            try {
                if (typeof theme !== 'undefined' && theme.fn && $.isFunction($.fn['themePluginCounter'])) {
                    theme.fn.dynIntObsInit('.counters [data-to]', 'themePluginCounter', theme.PluginCounter ? theme.PluginCounter.defaults : {});
                }
            } catch (e) {}

            var owl = $(".owl-carousel");
            owl.owlCarousel({
                'items': 1,
                'margin': 10,
                'loop': true, 
                'nav': true, 
                'dots': true,
                'autoplay': true
            });

        }
      });
    }
    setTimeout(loadajax,1);
    });
  </script>
@endpush





