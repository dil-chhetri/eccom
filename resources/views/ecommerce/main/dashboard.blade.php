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
								<h1>Shop Product <span clsas="d-block">Instanly</span></h1>
								<p class="mb-4">Refined and selected products best for the customer. 9 out 10 customer's have a good time and response shopping with us</p>
								<p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="assets/images/bowl-2.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Products</h2>
						<p class="mb-4">Item of various category available. Genuine 100% product. </p>
						<p><a href="{{url('/')}}/view-products" class="btn">Explore</a></p>
					</div> 
					<!-- End Column 1 -->
                    @php
                    $i = 0;
                    $limit = 3;
                    $count = count($products)
                    @endphp
					<!-- Start Column 2 -->
                    @while($i < $limit && $i < $count)
                    @php
					
                    $data = $products[$i];
                    @endphp
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0 product">
						<input type="hidden" name="" value="{{$data->product_id}}" class="product_id">
						<input type="hidden" name="" class="quantity-amount" value="1">
						<a class="product-item" href="{{route('product.view',['product_id'=> $data->product_id])}}">
                        @php 
                        $image = explode('|', $data->images);
                        $position = rand(0, count($image)-1)
                        @endphp
							<img src="{{url('upload/images').'/'.$image[$position]}}" class="img-fluid product-thumbnail">
							<h3 class="product-title">{{$data->product_name}}</h3>
							<strong class="product-price">{{$data->price}}</strong>

							<span class="icon-cross">

                                
								<img src="assets/images/cross.svg"" class="img-fluid addCart">
                                
							</span>
						</a>
					</div> 
                    @php
                    ++$i;
                    @endphp
                    @endwhile

				</div>
			</div>
		</div>
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Why Choose Us</h2>
						<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Fast &amp; Free Shipping</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Easy to Shop</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>24/7 Support</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="assets/images/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Hassle Free Returns</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="assets/images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->

		@php 
		$categories = DB::table('categories')->select('parent_category','category_name','image')->distinct()->get();
		@endphp
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
						
							<div class="grid grid-1"><img src="{{url('upload/images').'/'.$categories[4]->image}}" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="{{url('upload/images').'/'.$categories[2]->image}}" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="{{url('upload/images').'/'.$categories[3]->image}}" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">Categories</h2>
						<p>Items of various categories.Something for everyone</p>

						<ul class="list-unstyled custom-list my-4">
							@php 
							$iCat = 0;
							
							$countCat = count($categories);
							@endphp
							@while($iCat< $countCat)
							@php 
							$data = $categories[$iCat];
							@endphp
							<li>{{$data->category_name}}</li>
							@php 
							++$iCat;
							@endphp
							@endwhile
						</ul>

					</div>
				</div>
			</div>
		</div>

	
@endsection