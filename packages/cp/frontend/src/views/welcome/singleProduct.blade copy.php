@extends('frontend::layouts.frontendMaster')
@section('title',$ws->website_title)


@section('content') 
<div role="main" class="main shop pt-4">
		{{-- <div class="container">
			<div class="row">
				<div class="col">
					<ul class="breadcrumb breadcrumb-style-2 d-block text-4 mb-4">
						<li><a href="{{ url('/')}}" class="text-color-default text-color-hover-primary text-decoration-none">Home</a></li>
						<li><a href="" class="text-color-default text-color-hover-primary text-decoration-none">
							@foreach ($product->productCategories as $cat)
								{{ $cat->name  }}
							@endforeach
							</a>
						</li>
						<li><a href="" class="text-color-default text-color-hover-primary text-decoration-none">
							@foreach ($product->productSubcategories as $subcat)
								{{ $subcat->name  }}
							@endforeach
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 mb-5 mb-md-0">

					<div class="thumb-gallery-wrapper">
						<div class="thumb-gallery-detail owl-carousel owl-theme manual nav-inside nav-style-1 nav-dark mb-3">
							<div>
								<img alt="" class="img-fluid" src="{{asset("storage/product_images/".$product->fi()) }}">

								
							</div>
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
							<span class="sale text-color-dark">
								{{ $product->price }}
							</span>
							
						</p>

						<p class="text-3-5 mb-3">
							{!! $product->description !!}
						</p>

						<form method="post" action="{{ route('addToCart')}}" method="post">
							@csrf
							<hr>
							<input type="hidden" name="product_id" value="{{ $product->id }}">
						
								
							<input type="hidden" name="quantity" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
							
						
							<button type="submit" class="btn btn-dark btn-modern text-uppercase bg-color-hover-primary border-color-hover-primary">Add to cart</button>
							<hr>
						</form>

						<div class="d-flex align-items-center">
							<ul class="social-icons social-icons-medium social-icons-clean-with-border social-icons-clean-with-border-border-grey social-icons-clean-with-border-icon-dark me-3 mb-0">
								<!-- Facebook -->
								<li class="social-icons-facebook">
									<a href="http://www.facebook.com/sharer.php?u=https://www.okler.net" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Facebook">
										<i class="fab fa-facebook-f"></i>
									</a>
								</li>
								<!-- Google+ -->
								<li class="social-icons-googleplus">
									<a href="https://plus.google.com/share?url=https://www.okler.net" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Google+">
										<i class="fab fa-google-plus-g"></i>
									</a>
								</li>
								<!-- Twitter -->
								<li class="social-icons-twitter">
									<a href="https://twitter.com/share?url=https://www.okler.net&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Twitter">
										<i class="fab fa-twitter"></i>
									</a>
								</li>
								<!-- Email -->
								<li class="social-icons-email">
									<a href="mailto:?Subject=Share This Page&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://www.okler.net" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share By Email">
										<i class="far fa-envelope"></i>
									</a>
								</li>
							</ul>
						
						</div>

					</div>

				</div>
			</div>

			
		</div> --}}

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
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pplg','filename' => $product->fi() ]) }}" data-zoom-image="{{ route('imagecache', [ 'template'=>'pplg','filename' => $product->fi() ]) }}">
						</div>
						
						<div>
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pplg','filename' => $product->fi() ]) }}" data-zoom-image="{{ route('imagecache', [ 'template'=>'pplg','filename' => $product->fi() ]) }}">
						</div>
						<div>
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pplg','filename' => $product->fi() ]) }}" data-zoom-image="{{ route('imagecache', [ 'template'=>'pplg','filename' => $product->fi() ]) }}">
						</div>
						
					</div>
					<div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs">
						<div class="cur-pointer">
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'ppxlg','filename' => $product->fi() ]) }}">
						</div>
						<div class="cur-pointer">
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $product->fi() ]) }}">
						</div>
						<div class="cur-pointer">
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $product->fi() ]) }}">
						</div>
						<div class="cur-pointer">
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $product->fi() ]) }}">
						</div>
						<div class="cur-pointer">
							<img alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $product->fi() ]) }}">
						</div>
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
							<span class="amount">
								{{ $product->price }}Tk
							</span>
							
						</p>

						<p class="text-3-5 mb-3">
							{!! $product->description !!}
						</p>

					

					<form method="post" action="{{ route('addToCart')}}">
						@csrf
						<hr>
						<input type="hidden" name="product_id" value="{{ $product->id }}">

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
								<a href="http://www.facebook.com/sharer.php?u=https://www.okler.net" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Facebook">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<!-- Google+ -->
							<li class="social-icons-googleplus">
								<a href="https://plus.google.com/share?url=https://www.okler.net" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Google+">
									<i class="fab fa-google-plus-g"></i>
								</a>
							</li>
							<!-- Twitter -->
							<li class="social-icons-twitter">
								<a href="https://twitter.com/share?url=https://www.okler.net&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Twitter">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<!-- Email -->
							<li class="social-icons-email">
								<a href="mailto:?Subject=Share This Page&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://www.okler.net" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share By Email">
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
											Name:
										</th>
										<td class="border-top-0">
											{{ $product->name }}
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

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="product-thumb-info-badges-wrapper">
										<span class="badge badge-ecommerce badge-success">NEW</span>

									</div>

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-1.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">electronics</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Photo Camera</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$69,00</span>
									<span class="amount">$59,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="product-thumb-info-badges-wrapper">
										<span class="badge badge-ecommerce badge-success">NEW</span>
										<span class="badge badge-ecommerce badge-danger">27% OFF</span>
									</div>

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image product-thumb-info-image-effect">
											<img alt="" class="img-fluid" src="img/products/product-grey-7.jpg">

												<img alt="" class="img-fluid" src="img/products/product-grey-7-2.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Porto Headphone</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$199,00</span>
									<span class="amount">$99,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-2.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">sports</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Golf Bag</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$29,00</span>
									<span class="amount">$19,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="product-thumb-info-badges-wrapper">

										<span class="badge badge-ecommerce badge-danger">27% OFF</span>
									</div>

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<div class="countdown-offer-wrapper">
										<div class="text-color-light text-2" data-plugin-countdown data-plugin-options="{'date': '2022/01/01 12:00:00', 'numberClass': 'text-color-light', 'wrapperClass': 'text-color-light', 'insertHTMLbefore': '<span>OFFER ENDS IN </span>', 'textDay': 'DAYS', 'textHour': ':', 'textMin': ':', 'textSec': '', 'uppercase': true}"></div>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-3.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">sports</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Workout</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$40,00</span>
									<span class="amount">$30,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-4.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Luxury Bag</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$99,00</span>
									<span class="amount">$79,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-5.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Styled Bag</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$199,00</span>
									<span class="amount">$119,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-6.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">hat</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Blue Hat</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$299,00</span>
									<span class="amount">$289,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-8.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Adventurer Bag</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$99,00</span>
									<span class="amount">$79,00</span>
								</p>
							</div>

							<div class="product mb-0">
								<div class="product-thumb-info border-0 mb-3">

									<div class="addtocart-btn-wrapper">
										<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
											<i class="icons icon-bag"></i>
										</a>
									</div>

									<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
										QUICK VIEW
									</a>
									<a href="shop-product-sidebar-left.html">
										<div class="product-thumb-info-image">
											<img alt="" class="img-fluid" src="img/products/product-grey-9.jpg">

										</div>
									</a>
								</div>
								<div class="d-flex justify-content-between">
									<div>
										<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">sports</a>
										<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Baseball Ball</a></h3>
									</div>
									<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
								</div>
								<div title="Rated 5 out of 5">
									<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
								</div>
								<p class="price text-5 mb-3">
									<span class="sale text-color-dark font-weight-semi-bold">$399,00</span>
									<span class="amount">$299,00</span>
								</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
@endsection


@push('scripts')
<!-- Examples -->
		<script src="{{asset("/frontend/js/examples/examples.gallery.js")}}"></script>		
@endpush





