<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Single Product</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">


		<link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
        <link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset("/frontend/vendor/bootstrap/css/bootstrap.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/fontawesome-free/css/all.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/animate/animate.compat.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/simple-line-icons/css/simple-line-icons.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/owl.carousel/assets/owl.carousel.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/owl.carousel/assets/owl.theme.default.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/magnific-popup/magnific-popup.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/bootstrap-star-rating/css/star-rating.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.css")}}">

		<!-- Theme CSS -->
		
		<link rel="stylesheet" href="{{asset("/frontend/css/theme.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/css/theme-elements.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/css/theme-blog.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/css/theme-shop.css")}}">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{asset("/frontend/css/skins/default.css")}}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset("/frontend/css/custom.css")}}">

		<!-- Head Libs -->
		<script src="{{asset("/frontend/vendor/modernizr/modernizr.min.js")}}"></script>

	</head>
	<body data-plugin-page-transition>
      
		<div class="body">
			
			 @include('frontend::layouts.frontendHeader')

			<div role="main" class="main shop pt-4">

				<div class="container">

					<div class="row">
						<div class="col">
							<ul class="breadcrumb breadcrumb-style-2 d-block text-4 mb-4">
								<li>
									<i class="fa fa-home"></i>
									<a href="{{ url('/')}}" class="text-color-default text-color-hover-primary text-decoration-none">Home</a>
								</li>
								
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5 mb-5 mb-md-0">

							<div class="thumb-gallery-wrapper">
								<div class="thumb-gallery-detail owl-carousel owl-theme manual nav-inside nav-style-1 nav-dark mb-3">
									<div>
										<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}" data-zoom-image="{{ route('imagecache', [ 'template'=>'original','filename' => $product->fi() ]) }}">
									</div>
									@foreach($product->activeProductImages() as $image)
									<div>
										<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'original','filename' => $image->fi() ]) }}" data-zoom-image="{{ route('imagecache', [ 'template'=>'original','filename' => $image->fi() ]) }}">
									</div>
									@endforeach
								</div>
								<div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs">
									<div class="cur-pointer">
										<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $product->fi() ]) }}">
									</div>
									 @foreach($product->activeProductImages() as $image)
									<div class="cur-pointer">
										<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $image->fi() ]) }}">
									</div>
									@endforeach
								</div>
							</div>

						</div>

						<div class="col-md-7">

							<div class="summary entry-summary position-relative">


								<h1 class="mb-0 font-weight-bold text-7">
										{{ $product->name }}
								</h1>


								<div class="divider divider-small">
									<hr class="bg-color-grey-scale-4">
								</div>

								<p class="price mb-3">
									
									<span class="amount">{{ $product->price }}Tk</span>
								</p>

								<p class="text-3-5 mb-3">{!! $product->description !!}</p>

								

								<form  method="post" class="cart" action="{{ route('addToCart')}}">
                                     @csrf
									 <input type="hidden" value="{{ $product->id}}" name="product_id">
									<hr>
									<div class="quantity quantity-lg">
										<input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
									</div>
									<button type="submit" class="btn btn-dark btn-modern text-uppercase bg-color-hover-primary border-color-hover-primary">Add to cart</button>
									<hr>
								</form>

								<div class="d-flex align-items-center">
									<ul class="social-icons social-icons-medium social-icons-clean-with-border social-icons-clean-with-border-border-grey social-icons-clean-with-border-icon-dark me-3 mb-0">
										<!-- Facebook -->
										<li class="social-icons-facebook">
											<a href="https://www.facebook.com/matson.com.bd" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Facebook">
												<i class="fab fa-facebook-f"></i>
											</a>
										</li>
										
										
										<!-- Email -->
										<li class="social-icons-email">
											<a href="mailto: {{ $ws->contact_email}}" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share By Email">
												<i class="far fa-envelope"></i>
											</a>
										</li>
									</ul>
									
								</div>

							</div>

						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<div id="description" class="tabs tabs-simple tabs-simple-full-width-line tabs-product tabs-dark mb-2">
								<ul class="nav nav-tabs justify-content-start">
									<li class="nav-item"><a class="nav-link active font-weight-bold text-3 text-uppercase py-2 px-3" href="#productDescription" data-bs-toggle="tab">Description</a></li>
									<li class="nav-item"><a class="nav-link font-weight-bold text-3 text-uppercase py-2 px-3" href="#productInfo" data-bs-toggle="tab">Additional Information</a></li>
									
								</ul>
								<div class="tab-content p-0">
									<div class="tab-pane px-0 py-3 active" id="productDescription">
										<p>{!! $product->description !!} </p>
										
									</div>
									<div class="tab-pane px-0 py-3" id="productInfo">
										<table class="table table-striped m-0">
											<tbody>
												<tr>
													<th class="border-top-0">
														Name
													</th>
													<td class="border-top-0">
														{{$product->name}}
													</td>
												</tr>
												
											</tbody>
										</table>
									</div>
									
								</div>
							</div>
						</div>
					</div>



					

					<div class="row">
						<div class="col">
							<h4 class="font-weight-semibold text-4 mb-3">RELATED PRODUCTS</h4>
							<hr class="mt-0">
							<div class="products row">
								<div class="col">
									<div class="owl-carousel owl-theme nav-style-1 nav-outside nav-outside nav-dark mb-0" data-plugin-options="{'loop': false, 'autoplay': false, 'items': 4, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'autoHeight': true, 'stagePadding': '75', 'navVerticalOffset': '50px'}">

										@foreach($relatedProducts as $product)

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
												<a href="{{ route('singleProduct',[ 'product' => $product->id, 'slug' => $product->slug ?? " " ])}}">
													<div class="product-thumb-info-image">
														<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'ppxlg','filename' => $product->fi() ]) }}">

													</div>
												</a>
											</div>
											<div class="text-center">
												<div>
													<h3 class="text-5 font-weight-medium text-transform-none line-height-3 mb-0"><a href="{{ route('singleProduct',[ 'product' => $product->id, 'slug' => $product->slug ?? " " ])}}" class="text-color-dark text-color-hover-primary">{{ $product->name}}</a></h3>
														<span class="sale text-color-dark text-4 font-weight-semi-bold">Tk.{{$product->price}}</span>
													</p>
												</div>
		
											</div>
											
										</div>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>

					
				</div>

			</div>

			@include('frontend::layouts.frontendFooter')
		</div>

		<!-- Vendor -->
		<script src="{{asset("/frontend/vendor/jquery/jquery.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.appear/jquery.appear.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.easing/jquery.easing.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.cookie/jquery.cookie.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.validation/jquery.validate.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.gmap/jquery.gmap.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/lazysizes/lazysizes.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/isotope/jquery.isotope.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/owl.carousel/owl.carousel.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/magnific-popup/jquery.magnific-popup.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/vide/jquery.vide.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/vivus/vivus.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/bootstrap-star-rating/js/star-rating.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.countdown/jquery.countdown.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/elevatezoom/jquery.elevatezoom.min.js")}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset("/frontend/js/theme.js")}}"></script>

		<!-- Current Page Vendor and Views -->
		<script src="{{asset("/frontend/js/views/view.shop.js")}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset("/frontend/js/custom.js")}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset("/frontend/js/theme.init.js")}}"></script>

	<!-- Examples -->
		<script src="{{asset("/frontend/js/examples/examples.gallery.js")}}"></script>	

	</body>
</html>



