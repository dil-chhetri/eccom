@extends('ecommerce.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main')

		<!-- Start Hero Section -->
        <div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								@isset($category)
								<h1>{{$category->category_name}}</h1>
								@else
								<h1>Products</h1>
								@endisset
							</div>
						</div>
						<div class="col-lg-7">
							@isset($category)
						<div class="hero-img-wrap">
								<img src="{{url('upload/images').'/'.$category->image}}" class="img-fluid" alt="{{$category->image}}" style="width:500px;height:350px;">
							</div>
							@endisset
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
					@if(count($products) > 0)
		      		<!-- Start Column 1 -->
                    @foreach($products as $item)
					<div class="col-12 col-md-4 col-lg-3 mb-5 product">
					<input type="hidden" name="" value="{{$item->product_id}}" class="product_id">
						<a class="product-item" href="#">
                            @php
                            $image = explode('|', $item->images);
                            $position = rand(0, count($image)-1);
                            @endphp
							<img src="{{url('upload/images'.'/'.$image[$position])}}" class="img-fluid product-thumbnail">
							<h3 class="product-title">{{$item->product_name}}</h3>
							<strong class="product-price">{{$item->price}}</strong>

							<span class="icon-cross">
								<img src="assets/images/cross.svg" class="img-fluid addCart">
							</span>
						</a>
					</div> 
                    @endforeach
					@else
					<h6>No products available.</h6>
					@endif

		      	</div>
		    </div>
		</div>

@endsection