@extends('ecommerce.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main')
		
		    <div class="container">
		      <div class="row mb-5">
		        <div class="col-md-12">
		          <div class="border p-4 rounded" role="alert">
				  @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                    @else
                    <p class="text-success">{{ session('success') }}</p>
                    @endisset
		          </div>
		        </div>
		      </div>
              <form action="{{url('/')}}/place-order" method="post">
                @csrf
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            <div class="form-group">
		              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
		              <select id="" class="form-control" name="country">
						@if(!is_null($address))
						<option value="{{$address->country}}">{{$address->country}}</option>    
						@endif
						<option value="" disabled>Select a country</option>    
                        <option value="Nepal">Nepal</option>    
                        <option value="India">India</option>    
                        <option value="Pakistan">Pakistan</option>    
                        <option value="Afghanistan">Afghanistan</option>    
                        <option value="China">China</option>    
                        <option value="Bhutan">Bhutan</option>    
                        <option value="Bangladesh">Bangladesh</option>    
                        <option value="Sri Lanka">Sri Lanka</option>      
		              </select>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_fname" name="c_fname" value="{{session('user')['first_name']}}" disabled> 
		              </div>
		              <div class="col-md-6">
		                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_lname" name="c_lname" value="{{session('user')['last_name']}}" disabled>
		              </div>
		            </div>



		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_street" name="street_address" placeholder="Street address" value="{{ old('street_address', $address ? $address->street_address : '') }}">
		              </div>
		            </div>

		            <div class="form-group mt-3">
		              <input type="text" class="form-control" placeholder="city" name="city" value="{{ old('city', $address ? $address->city : '') }}">
		            </div>

		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_state_country" class="text-black">State<span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_state_country" name="state" value="{{ old('state', $address ? $address->state : '') }}">
		              </div>
		              <div class="col-md-6">
		                <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_postal_zip" name="zip_code" value="{{ old('zip_code', $address ? $address->zip_code : '') }}">
		              </div>
		            </div>

		            <div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_email_address" name="email_address" value="{{session('user')['email']}}" disabled>
		              </div>
		              <div class="col-md-6">
		                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_phone" name="phone_number" placeholder="Phone Number" value="{{session('user')['phone_number']}}" disabled>
		              </div>
		            </div>
		            <div class="form-group">
		              <label for="c_order_notes" class="text-black">Order Notes</label>
		              <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
		            </div>

		          </div>
		        </div>
		        <div class="col-md-6">

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Coupon Code</h2>
		              <div class="p-3 p-lg-5 border bg-white">

		                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
		                <div class="input-group w-75 couponcode-wrap">
		                  <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
		                  <div class="input-group-append">
		                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
		                  </div>
		                </div>

		              </div>
		            </div>
		          </div>

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Your Order</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
							@php 
							$total = 0;
							$productNames = [];
							@endphp
                            @foreach($cartProducts as $item)
							@php
							$productNames[] = $item->product_name;
							@endphp
		                    <tr>
                               <input type="hidden" name="cart_id" value="{{$item->cart_id}}">
		                      <td>{{$item->product_name}} <strong class="mx-2">x</strong> {{$item->cart_quantity}}</td>
		                      <td>Rs.{{$item->price}}</td>
		                    </tr>
							@php 
							$total += $item->price * $item->cart_quantity;
							@endphp
                            @endforeach
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
		                      <td class="text-black">Rs.{{$total}}</td>
		                    </tr>
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
		                      <td class="text-black font-weight-bold"><strong>Rs.{{$total}}</strong></td>
		                    </tr>
		                  </tbody>
		                </table>
	
				
						<input type="hidden" name="total" value="{{$total}}">
						@foreach($cartProducts as $item)

						<input type="hidden" name="productname[]" value="{{$item->product_name}}">
						@endforeach
						<div class="form-group">
						<input class="btn btn-black btn-lg py-3 btn-block" type="submit" value="Card Pay" name="cardPayment">
						</div>
			
		                <div class="form-group">
		                  <input class="btn btn-black btn-lg py-3 btn-block"  type="submit" value="Cash on delivery" name="cashPayment">
		                </div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
              </form>
		      
		    </div>
		  
@endsection