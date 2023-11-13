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
              <form action="{{route('place.order')}}" method="post">
                @csrf
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            <div class="form-group">
		              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
		              <select id="" class="form-control" name="country">
                        <option value="{{$address->country}}">{{$address->country}}</option>    
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
		                <input type="text" class="form-control" id="c_street" name="street_address" placeholder="Street address" value="{{$address->street_address}}">
		              </div>
		            </div>

		            <div class="form-group mt-3">
		              <input type="text" class="form-control" placeholder="city" name="city" value="{{$address->city}}">
		            </div>

		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_state_country" class="text-black">State<span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_state_country" name="state" value="{{$address->state}}">
		              </div>
		              <div class="col-md-6">
		                <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_postal_zip" name="zip_code" value="{{$address->zip_code}}">
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
                      <span class="text-dark fw-bold">{{$order->order_status}}</span>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
                          @php 
							$total = 0;
							@endphp
                            @foreach($orderItems as $item)
		                    <tr>
                               <input type="hidden" name="cart_id" value="{{$item->product_id}}">
		                      <td>{{$item->product_name}} <strong class="mx-2">x</strong> {{$item->order_item_quantity}}</td>
		                      <td>Rs.{{$item->price}}</td>
		                    </tr>
                            @php 
							$total += $item->price * $item->order_item_quantity;
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

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

		                  <div class="collapse" id="collapsebank">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

		                  <div class="collapse" id="collapsecheque">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-5">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

		                  <div class="collapse" id="collapsepaypal">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <input class="btn btn-black btn-lg py-3 btn-block"  type="submit" value="Place Order">
		                </div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
              </form>
		      
		    </div>
		  
@endsection