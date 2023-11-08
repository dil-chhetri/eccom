@extends('ecommerce.admin.layouts.main')
@push('title')
<title>view-products</title>
@endpush
@section('main-contain')
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                    @else
                    <p class="text-success">{{ session('success') }}</p>
                    @endisset
                    </div>
                    <div class="card-body" id="products_table">
                        <a href="{{url('/')}}/view-trash" class="btn btn-success">Trash</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Brand</h>
                                    <th>Actions</th>
                                    


                                </tr>
                            </thead>
                            <tbody>
                           @foreach($products as $item)
                                        <tr>
                                            <td>{{$item->category}}</td>

                                            <td>{{$item->product_name}}</td>
                                           
                                            <td>
                                                @php
                                                $images = explode('|', $item->images);
                                                @endphp
                                                @foreach($images as $img)
                                                <img src="upload/images/{{$img}}" srcset="" width="50px" height="50px"  class="img">
                                                @endforeach
                                            </td>
                                            <td>{{$item->price}}</td>
                                            
                                            <td>{{$item->brand}}</td>

                                            <td>
                                                <a href="{{route('edit.product',['product_id' => $item->product_id ])}}" class="btn btn-info ">Edit</a>
                                              
                                           
                                                <a href="{{route('delete.product',['product_id' => $item->product_id ])}}" class="btn btn-danger ">Delete</a>
                                            
                                                
                                               
                                                
                                            </td>

                                        </tr>
                            @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection