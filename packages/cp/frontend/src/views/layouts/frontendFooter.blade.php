<footer id="footer" class="cp-footer border-top-0 mt-0">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-12 col-md-3">
                <h5 class="cp-footer__title mb-3">Products</h5>
                <ul class="cp-footer__list">
                    @foreach(($productCats ?? collect())->take(8) as $cat)
                        <li>
                            <a href="{{ route('productCategory', ['cat' => $cat->id, 'slug' => $cat->slug ?? '']) }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="cp-footer__title mb-3">About Us</h5>
                <ul class="cp-footer__list">
                    @php
                        $aboutMenu = collect($headerMenus ?? $footerMenus ?? [])->firstWhere('id', 5);
                    @endphp

                    @if($aboutMenu)
                        @if(!empty($aboutMenu->link))
                            <li><a href="{{ $aboutMenu->link }}">{{ $aboutMenu->name }}</a></li>
                        @endif

                        @if($aboutMenu->pages)
                            @foreach (collect($aboutMenu->latestPages())->take(8) as $page)
                                @if($page->link)
                                    <li><a href="{{ $page->link }}">{{ $page->name }}</a></li>
                                @else
                                    <li><a href="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)]) }}">{{ $page->name }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @else
                        @foreach(($footerMenus ?? collect())->take(8) as $menu)
                            @if(!empty($menu->link))
                                <li><a href="{{ $menu->link }}">{{ $menu->name }}</a></li>
                            @else
                                <li><a href="javascript:void(0)">{{ $menu->name }}</a></li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="cp-footer__title mb-3">
                    @if(!empty($ws->contact_email))
                        <a href="mailto:{{ $ws->contact_email }}" class="cp-footer__title-link">
                            <i class="far fa-envelope me-2"></i>{{ $ws->contact_email }}
                        </a>
                    @else
                        Contact
                    @endif
                </h5>

                @if(!empty($ws->footer_address))
                    <div class="cp-footer__block">
                        {!! nl2br(e($ws->footer_address)) !!}
                    </div>
                @elseif(!empty($ws->contact_address))
                    <div class="cp-footer__block">
                        <i class="fas fa-map-marker-alt me-2"></i>{!! nl2br(e($ws->contact_address)) !!}
                    </div>
                @endif

                @if(!empty($ws->contact_mobile))
                    <div class="cp-footer__block mt-2">
                        <i class="fas fa-phone me-2"></i><a href="tel:{{ $ws->contact_mobile }}">{{ $ws->contact_mobile }}</a>
                    </div>
                @endif

                <div class="mt-3">
                    <ul class="cp-footer__social">
                        @if(!empty($ws->fb_url))
                            <li><a href="{{ $ws->fb_url }}" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if(!empty($ws->instagram_url))
                            <li><a href="{{ $ws->instagram_url }}" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if(!empty($ws->linkedin_url))
                            <li><a href="{{ $ws->linkedin_url }}" target="_blank" rel="noopener" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if(!empty($ws->twitter_url))
                            <li><a href="{{ $ws->twitter_url }}" target="_blank" rel="noopener" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if(!empty($ws->youtube_url))
                            <li><a href="{{ $ws->youtube_url }}" target="_blank" rel="noopener" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="cp-footer__title mb-3">Messages</h5>
                <form action="{{ route('contactUs') }}" method="POST" class="cp-footer__form">
                    @csrf
                    <div style="position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden;" aria-hidden="true">
                        <label for="hp_website_footer">Website</label>
                        <input type="text" name="hp_website" id="hp_website_footer" tabindex="-1" autocomplete="off" value="">
                    </div>
                    <input type="hidden" name="hp_time" value="{{ now()->timestamp }}">
                    <input type="hidden" name="subject" value="Footer Message">

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-2">
                            Please fill all the fields.
                        </div>
                    @endif

                    @if(Session::has('message'))
                        <div class="alert alert-danger py-2 mb-2">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <div class="mb-2">
                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control cp-footer__input" placeholder="Name" required>
                    </div>
                    <div class="mb-2">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control cp-footer__input" placeholder="E-mail" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="number" value="{{ old('number') }}" class="form-control cp-footer__input" placeholder="Phone" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" rows="4" class="form-control cp-footer__input cp-footer__textarea" placeholder="Message" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-light w-100 cp-footer__submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <div class="cp-footer__bottom">
        <div class="container py-3">
            <div class="row">
                <div class="col text-center">
                    <div class="cp-footer__bottom-text">
                        
                            {{ date('Y') }} © All rights reserved. developed by <a href="https://a2sys.co" target="_blank" rel="noopener">a2sys</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


