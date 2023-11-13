@extends('ecommerce.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main')
        <div class="br-light py-4" style="height: 80vh!important;">
            <div class="container product mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            @php 
                            $images = explode('|',$product->images);
                            @endphp
                          <img src="{{url('upload/images').'/'.$images[0]}}" alt="Product Image" srcset="" class="w-100">
                        </div>

                          @php 
                            $images = explode('|',$product->images);
                            @endphp
                            @foreach($images as $image)
                          <img src="{{url('upload/images').'/'.$image}}" alt="Product Image" srcset="" width="50px" height="50px" class="m-2">
                            @endforeach       
                    </div>
               


                    <div class="col-md-8">
						<input type="hidden" name="" value="{{$product->product_id}}" class="product_id">

                        <h4 class="text-dark fw-bold">{{$product->product_name}}
                        </h4>
                        <hr>
                        <p>{{$product->description}}</p>

                        <div class="row">
                        <div class="col-md-6">
                            <h6>Rs. <span class="text-dark fw-bold">{{$product->price}} </span></h6>
                                
                            </div>

                            
                        </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                        
                                        <div class="input-group mb-3 cart_data" style="width: 130px;">
                                            <button class="input-group-text decrease">-</button>
                                            <input type="text" class="form-control bg-white text-center quantity-amount" value="1" disabled>
                                            <button class="input-group-text increase">+</button>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-5">
                             <button class="btn btn-dark px-4 addCart" value=">"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                            </div>



                    </div>
                </div>
            </div>
        </div>
@endsection