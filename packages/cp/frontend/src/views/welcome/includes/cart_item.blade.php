
<div class="row">
    <div class="col">
        <ul class="breadcrumb font-weight-bold text-6 justify-content-center my-5">
            <li class="text-transform-none me-2">
                <a href="{{ route('viewCart')}}" class="text-decoration-none text-color-primary">Shopping Cart</a>
            </li>
            <li class="text-transform-none text-color-grey-lighten me-2">
                <a href="{{ route('checkout')}}" class="text-decoration-none text-color-grey-lighten text-color-hover-primary">Checkout</a>
            </li>
            <li class="text-transform-none text-color-grey-lighten">
                <a href="{{route('orderConfirmed')}}" class="text-decoration-none text-color-grey-lighten text-color-hover-primary">Order Complete</a>
            </li>
        </ul>
    </div>
</div>
<div class="row pb-4 mb-5">
    <div class="col-lg-8 mb-5 mb-lg-0">
        <form method="post" action="">
            <div class="table-responsive">
                <table class="shop_table cart">
                    @if($collection->count() > 0)
                    <thead>
                        <tr class="text-color-dark">
                            <th class="product-thumbnail" width="15%">
                                &nbsp;
                            </th>
                            <th class="product-name text-uppercase" width="30%">
                                Product
                            </th>
                            <th class="product-price text-uppercase" width="15%">
                                Price
                            </th>
                            <th class="product-quantity text-uppercase" width="20%">
                                Quantity
                            </th>
                            <th class="product-subtotal text-uppercase text-end" width="20%">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>
                        @foreach ($collection as $cart)
                        <tr class="cart_table_item">
                            <td class="product-thumbnail">
                                <div class="product-thumbnail-wrapper">
                                    <a href="#" class="product-thumbnail-remove
                                    cartRemoveItem" title="Remove Product" data-cartId ="{{$cart->id}}" data-url="{{ route('cartRemoveItem') }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a href="shop-product-sidebar-right.html" class="product-thumbnail-image" title="Photo Camera">
                                        <img width="90" height="90" alt="" class="img-fluid" src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cart->product->fi() ]) }}">
                                    </a>
                                </div>
                            </td>
                            <td class="product-name">
                                <a href="shop-product-sidebar-right.html" class="font-weight-semi-bold text-color-dark text-color-hover-primary text-decoration-none">
                                    {{ Str::limit( $cart->product->name, 30)}}
                                </a>
                            </td>
                            <td class="product-price">
                                <span class="amount font-weight-medium text-color-grey">
                                    {{ $cart->product->price }}
                                </span>
                            </td>
                            <td class="product-quantity">
                                <div class="quantity float-none m-0">
                                    <input type="button" class="minus updateCartItem text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-"  data-cartid="{{$cart->id}}" data-qty="{{$cart->quantity}}"  data-url="{{ route('cartUpdateQty') }}">
                                    <input type="text" class="input-text qty text" title="Qty" value="{{ $cart->quantity }}" name="quantity" min="1" step="1">
                                    <input type="button" class="plus updateCartItem text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+"  data-cartid="{{$cart->id}}" data-qty="{{$cart->quantity}}"  data-url="{{ route('cartUpdateQty') }}">
                                </div>
                            </td>
                            <td class="product-subtotal text-end">
                                <span class="amount text-color-dark font-weight-bold text-4">{{ $cart->product->price * $cart->quantity}}Tk</span>
                            </td>
                        </tr>

                       
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
     @if($collection->count() > 0)
    <div class="col-lg-4 position-relative">
        <div class="card border-width-3 border-radius-0 border-color-hover-dark" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 85}}">
            <div class="card-body">
                <h4 class="font-weight-bold text-uppercase text-4 mb-3">Cart Totals</h4>
                <table class="shop_table cart-totals mb-4">
                    <tbody>
                        {{-- <tr class="cart-subtotal">
                            <td class="border-top-0">
                                <strong class="text-color-dark">Subtotal</strong>
                            </td>
                            <td class="border-top-0 text-end">
                                <strong><span class="amount font-weight-medium">{{totalCartAmount()}}Tk</span></strong>
                            </td>
                        </tr>
                        <tr class="shipping">
                            <td colspan="2">
                                <strong class="d-block text-color-dark mb-2">Shipping</strong>

                                <div class="d-flex flex-column">
                                    <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method1">
                                        <input id="shipping_method1" type="radio" class="me-2" name="shipping_method" value="free" checked />
                                        Free Shipping
                                    </label>
                                </div>
                            </td>
                        </tr> --}}
                        <tr class="total">
                            <td>
                                <strong class="text-color-dark text-3-5">Total</strong>
                            </td>
                            <td class="text-end">
                                <strong class="text-color-dark"><span class="amount text-color-dark text-5">{{totalCartAmount()}}Tk</span></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>


                 @if(Auth::check()) 
                  <a href="{{ route('checkout') }}" class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i></a>
                @else
                  <a href="{{ route('login') }}" class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i></a>
                @endif


                
            </div>
        </div>
    </div>
    @endif
</div>



@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
  $( document ).ready(function() {
    $(document).on("click",".updateCartItem",function() {

        var that = $( this );
        var url  = that.attr('data-url');
    
		if(that.hasClass('plus')){
			var cart_qty  = that.attr('data-qty');
		    new_qty = parseInt(cart_qty) + 1;
           
		}
		if(that.hasClass('minus')){
			var cart_qty  = that.attr('data-qty');
			if(cart_qty <=1 ){
                alert('product quantity minimum value 1!');
				return false;
               
			}
		    new_qty = parseInt(cart_qty) - 1;

             
		}

        var cart_id  = that.attr('data-cartid');
        
		$.ajax({
			url    : url,
            method : "post",
			data   : {cart_id : cart_id, new_qty : new_qty},
            success: function(result){
                if(result.status == false){
                   alert('Product Stock is Not Available!')
                }
                $(".totalCartAmount").html(result.totalCartAmount);
                $(".cartCount").html(result.cartCount);
			    $(".cartView").html(result.view);
	        },error:function(){
				alert("Error");
			}
       });
    });

      //delete cart Item
    $(document).on("click",".cartRemoveItem",function() {
        var that = $( this );
        let cart_id  = that.attr('data-cartId');
        var url  = that.attr('data-url');
        let result = confirm('Are you sure to delete this cart item?')
        if(result){
            $.ajax({
			url    : url,
            method : "post",
			data   : {cart_id : cart_id},
            success: function(result){
                 $(".totalCartAmount").html(result.totalCartAmount);
                $(".cartView").html(result.view);
                $(".cartCount").html(result.cartCount);
	        },error:function(){
				alert("Error");
			}
        });
        }
    });
    
  });
</script>
@endpush


