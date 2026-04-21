<div class="shop dialog dialog-lg fadeIn animated" style="animation-duration: 300ms;">
	<div class="row">
		<div class="col-lg-6">

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

		<div class="col-lg-6">

			<div class="summary entry-summary position-relative">

				@php
					$hasPrice = !blank($product->price) && floatval($product->price) > 0;
				@endphp

				<h1 class="mb-0 font-weight-bold text-7">
						{{ $product->name }}
				</h1>


				<div class="divider divider-small">
					<hr class="bg-color-grey-scale-4">
				</div>

				@if($hasPrice)
					<p class="price mb-3">
						<span class="amount">{{ $product->price }}Tk</span>
					</p>
				@else
					<div class="alert alert-info mb-3">
						<div class="font-weight-semibold mb-1">Contact Us</div>
						@if($ws && !empty($ws->contact_mobile))
							<div class="mb-1">
								Mobile:
								<a class="text-decoration-none" href="tel:{{ preg_replace('/\s+/', '', $ws->contact_mobile) }}">
									{{ $ws->contact_mobile }}
								</a>
							</div>
						@endif
						@if($ws && !empty($ws->contact_email))
							<div>
								Email:
								<a class="text-decoration-none" href="mailto:{{ $ws->contact_email }}">{{ $ws->contact_email }}</a>
							</div>
						@endif
					</div>
				@endif

				<p class="text-3-5 mb-3">{!! $product->description !!}</p>

				

				<div class="d-flex align-items-center">
					<ul class="social-icons social-icons-medium social-icons-clean-with-border social-icons-clean-with-border-border-grey social-icons-clean-with-border-icon-dark me-3 mb-0">
						<!-- Facebook -->
						@if($ws && !empty($ws->fb_url))
						<li class="social-icons-facebook">
							<a href="{{ $ws->fb_url }}" target="_blank" rel="noopener" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share On Facebook">
								<i class="fab fa-facebook-f"></i>
							</a>
						</li>
						@endif
	
						
						
						
						<!-- Email -->
						<li class="social-icons-email">
							<a href="mailto:{{ $ws->contact_email}}" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" title="Share By Email">
								<i class="far fa-envelope"></i>
							</a>
						</li>
					</ul>
				
				</div>

			</div>


		</div>
	</div>
</div>