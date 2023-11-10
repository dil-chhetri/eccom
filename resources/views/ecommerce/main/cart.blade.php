@extends('ecommerce.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main')

            <div class="container" style="height: 90vh!important;" >
            <div id="cart">
            @if(null !== session('user'))
                @if($item > 0)
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
                    
                    <table class="table" >
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                      
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($cartProducts as $item)
                        <tr class="cart_data">
                           <input type="hidden" class="cartId" value="{{$item->cart_id}}"> 
                          <td class="product-thumbnail">
                            @php 
                            $image = explode('|',$item->images)
                            @endphp
                            <img src="{{url('upload/images').'/'.$image[0]}}" alt="Image" class="img-fluid" style="width:70px!important;height:70px!important;">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-black">{{$item->product_name}}</h2>
                          </td>
                          <td>{{$item->price}}</td>
                          <td>
                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-black decrease updateQuantity" type="button">&minus;</button>
                              </div>
                              <input type="text" class="form-control text-center quantity-amount" value="{{$item->cart_quantity}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled>
                              <div class="input-group-append">
                                <button class="btn btn-outline-black increase updateQuantity" type="button">&plus;</button>
                              </div>
                            </div>
        
                          </td>
                          <td>Rs.{{$item->price * $item->cart_quantity}}</td>
                          <td><a href="#" class="btn btn-success btn-sm">Remove</a></td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
        
              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                      <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-black h4" for="coupon">Coupon</label>
                      <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                      <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-black">Apply Coupon</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">Rs.{{$item->price * $item->cart_quantity}}</strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">Rs.{{$item->price * $item->cart_quantity}}</strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @else
              <h6>No items in the cart</h6>
              @endif
              @else
              <h6>Login to continue</h6>
              @endif
              </div>
            </div>
         

	
@endsection