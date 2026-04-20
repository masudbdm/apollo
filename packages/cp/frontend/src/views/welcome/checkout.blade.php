@extends('frontend::layouts.frontendMaster')
@section('title','Matson')


@section('content') 
<div role="main" class="main shop pb-4">
    <div class="container">

        <div class="row">
            <div class="col">
                <ul class="breadcrumb breadcrumb-dividers-no-opacity font-weight-bold text-6 justify-content-center my-5">
                    <li class="text-transform-none me-2">
                        <a href="{{ route('viewCart')}}" class="text-decoration-none text-color-dark text-color-hover-primary">Shopping Cart</a>
                    </li>
                    <li class="text-transform-none text-color-dark me-2">
                        <a href="{{ route('checkout')}}" class="text-decoration-none text-color-primary">Checkout</a>
                    </li>
                    <li class="text-transform-none text-color-grey-lighten">
                        <a href="{{route('orderConfirmed')}}" class="text-decoration-none text-color-grey-lighten text-color-hover-primary">Order Complete</a>
                    </li>
                </ul>
            </div>
        </div>


        <form role="form" class="needs-validation" method="post" action="{{ route('orderStore')}}">
            @csrf
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">

                    <h2 class="text-color-dark font-weight-bold text-5-5 mb-3">Billing Details</h2>
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">Name <span class="text-color-danger">*</span></label>
                            <input type="text" class="form-control h-auto py-2" name="name" value="{{ old('name') ? : Auth::user()->name}}" required />
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control h-auto py-2" name="company_name" value="{{ old('company_name')}}"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">Mobile <span class="text-color-danger">*</span></label>
                            <input type="text" class="form-control h-auto py-2" name="mobile" placeholder="Mobile" value="{{ old('mobile')}}" required />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">Address <span class="text-color-danger">*</span></label>
                            <input type="text" class="form-control h-auto py-2" name="address" value="{{ old('address')}}" placeholder="Address" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                             <label class="form-label">Post Code <span class="text-color-danger">*</span></label>
                            <input type="text" class="form-control h-auto py-2" name="post_code" value="{{ old('post_code')}}" placeholder="Post Code" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">City <span class="text-color-danger">*</span></label>
                            <input type="text" class="form-control h-auto py-2" name="city" value="{{ old('city')}}" required />
                        </div>
                    </div>
                    
                   
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">Email Address <span class="text-color-danger">*</span></label>
                            <input type="email" class="form-control h-auto py-2" name="email" value="{{ old('email') ? : Auth::user()->email}}" required />
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label">Note</label>
                            <textarea class="form-control h-auto py-2" name="note" rows="5" placeholder="note about you orderm e.g. special note for delivery"></textarea>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 position-relative">
                    <div class="card border-width-3 border-radius-0 border-color-hover-dark" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 85}}">
                        <div class="card-body">
                            <h4 class="font-weight-bold text-uppercase text-4 mb-3">Your Order</h4>
                            <table class="shop_table cart-totals mb-3">
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="border-top-0">
                                            <strong class="text-color-dark">Product</strong>
                                        </td>
                                    </tr>
                                   
                                    @foreach ($collection as $cart)
                                    <tr>
                                        <td class="border-top-0 pt-0">
                                            <strong class="d-block text-color-dark line-height-1 font-weight-semibold">{{ Str::limit( $cart->product->name, 20)}}</strong>
                                            
                                        </td>
                                        <td class="border-top-0 text-end align-top pt-0">
                                            <span class="amount font-weight-medium text-color-grey"> {{ $cart->product->price * $cart->quantity}}Tk</span>
                                        </td>
                                    </tr>
                                    @endforeach

{{-- 
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
                                    <tr class="payment-methods">
                                        <td colspan="2">
                                            <strong class="d-block text-color-dark mb-2">Payment Methods</strong>

                                            <div class="d-flex flex-column">
                                                <label class="d-flex align-items-center text-color-grey mb-0" for="payment_method1">
                                                    <input id="payment_method1" type="radio" class="me-2" name="payment_method" value="cash-on-delivery" checked />
                                                    Cash On Delivery
                                                </label>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Place Order <i class="fas fa-arrow-right ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection







