@extends('ecommerce.layouts.main')
@push('title')
<title>Login</title>
@endpush
@section('main')
		<!-- Start login Form -->
		<div class="untree_co-section">
      <div class="container">

        <div class="block">
          <div class="row justify-content-center">
            @if(session('error'))
            <p class="text-danger">{{ session('error') }}</p>
            @else
            <p class="text-success">{{ session('success') }}</p>
            @endisset

            <div class="col-md-8 col-lg-8 pb-4">


              <div class="row mb-5">
                <div class="col-lg-4">
                  <div  class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                    <div class="service-icon color-1 mb-4">
                      <i class="fa fa-user fa-xl" aria-hidden="true"></i>
                    </div> 
                    <div class="service-contents">
                      <h4 class="text-dark fs-bold">Login</h4>
                    </div> 
                  </div> 
                </div>


              <form action="{{url('/')}}/login" method="post">
                @csrf
              <div class="form-group">
                  <label class="text-black" for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="fname">Username</label>
                      <input type="text" class="form-control" id="username" name="username">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="lname">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                  </div>
                </div>


                <button type="submit" class="btn btn-primary-hover-outline mt-4">Login</button>
              </form>

            </div>

          </div>

        </div>

      </div>


    </div>
  </div>

  <!-- End login Form -->
@endsection