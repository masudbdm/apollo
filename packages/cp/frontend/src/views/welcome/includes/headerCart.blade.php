 <div class="header-nav-feature header-nav-features-cart d-inline-flex ms-2">
    <a href="#" class="header-nav-features-toggle">
        <img src="{{asset('frontend/img/icons/icon-cart.svg')}}" width="14" alt="cart" class="header-nav-top-icon-img">
        <span class="cart-info">
            <span class="cart-qty cartCount">{{ totalCartItems()}}</span>
        </span>
    </a>
    <div class="header-nav-features-dropdown" id="headerTopCartDropdown">
        
        <div class="totals">
            <span class="label">Total:</span>
            <span class="price-total"><span class="totalCartAmount">{{totalCartAmount()}} Tk</span></span>
        </div>
        <div class="actions">
            <a class="btn btn-dark" href="{{ route('viewCart')}}">View Cart</a>

            @if(Auth::check())
                <a class="btn btn-primary" href="{{ route('checkout')}}">Checkout</a>
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">Checkout</a>
            @endif
        </div>
    </div>
</div>