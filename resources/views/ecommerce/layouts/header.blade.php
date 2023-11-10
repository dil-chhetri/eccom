<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  <meta name="csrf_token" content="{{ csrf_token() }}" />
	<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="{{url('assets/css/tiny-slider.css')}}" rel="stylesheet">
	<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
	
	@stack('title')

	</head>

	<body>

	
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" >

			<div class="container">
				<a class="navbar-brand" href="{{url('/')}}"><span><i class="fa fa-shopping-bag px-2" aria-hidden="true"></i></span>Eccom<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item active">
							<a class="nav-link" href="{{url('/')}}">Home</a>
						</li>
						<li><a class="nav-link" href="{{url('/')}}/view-products">Shop</a></li>
						<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Categories
						</a>
						@php 
						$categories = DB::table('categories')->select('parent_category','category_name','image')->distinct()->get();
						@endphp
						<ul class="dropdown-menu">
						@foreach($categories as $item)
						<li class="nav-item dropend">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#000!important;">
						{{$item->parent_category}}
						</a>
						<ul class="dropdown-menu">
						@foreach(DB::table('categories')->where('parent_category', $item->parent_category)->get() as $data)
						<li><a class="dropdown-item" href="{{route('products.category',['category_id' => $data->category_id])}}" style="color:#000!important;">{{$data->category_name}}</a></li>
						@endforeach
						</ul>
						</li>
						@endforeach
						</ul>
						</li>
						<li ><a class="nav-link" href="{{url('/')}}/cart">Cart</a></li>

					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						@if(session('user'))

						<li><a class="nav-link" href="#"><i class="fa fa-user"></i><span class="mx-2">{{session('user')['username']}}</span></a></li>
						<li><a class="nav-link " href="{{url('/')}}/logout"><i class="fa-solid fa-right-from-bracket"></i><span class="mx-2">Logout</span></a></li>

						@else
						<li><a class="nav-link" href="{{url('/')}}/login"><span class="mx-2">Login</span></a></li>
						<li><a class="nav-link" href="{{url('/')}}/register"><span class="mx-2">Register</span></a></li>
						@endif

					</ul>
				</div>
			</div>
				
		</nav>