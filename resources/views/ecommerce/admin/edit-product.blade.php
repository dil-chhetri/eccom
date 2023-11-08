@extends('ecommerce.admin.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main-contain')
<div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Product</h4>
                    @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                    @else
                    <p class="text-success">{{ session('success') }}</p>
                    @endisset
                        
                    </div>
                    <div class="card-body">
                        <form action="{{$url}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0">Select Category</label>
                                        <select name="category" class="form-select mb-2" >
                                                <option selected value="{{$product->category}}">{{$product->category}}</option>
                                                @foreach($categories as $item)
                                                <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                                                <option value="{{$item->parent_category}}">{{$item->parent_category}}</option>

                                                @endforeach
                                        </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="mb-0">Product Name</label>
                                    <input type="text" name="product_name"  class="form-control mb-2" placeholder="Enter category name" value="{{$product->product_name}}">
                                </div>

                                <div class="col-md-3">
                                    <label class="mb-0">Price</label>
                                    <input type="text" name="price"  class="form-control mb-2" placeholder="Enter original price" value="{{$product->price}}">
                                </div>

                                <div class="col-md-3">
                                    <label class="mb-0">Brand</label>
                                    <input type="text" name="brand"  class="form-control mb-2" placeholder="Enter brand name" value="{{$product->brand}}">
                                </div>

                                <div class="col-md-3">
                                    <label class="mb-0">Quanity</label>
                                    <input type="number" name="quantity"  class="form-control mb-2" placeholder="Enter quantity" value="{{$product->quantity}}">
                                </div>

                                <div class="col-md-12">
                                    <label class="mb-0">Description</label>
                                    <textarea name="description" id="" placeholder="Enter description" rows="3" class="form-control mb-2">{{$product->description}}</textarea>
                                </div>



                                <div class="col-md-12">
                                    <label for="" class="d-block">Product Images</label>
                                    @php
                                    $images = explode('|', $product->images);
                                    @endphp
                                    @foreach($images as $img)
                                    <img src="{{url('upload/images').'/'.$img}}" srcset="" width="100px" height="100px"  class="img" alt="{{$img}}">

                                    @endforeach
                                </div>

                                
                                <div class="col-md-12">
                                    <label class="mb-0">Upload Image</label>
                                    <input type="hidden" name="image" value="{{$product->images}}">
                                    <input type="file" name="image[]" id="" class="form-control mb-2" multiple>
                                </div>


                                
                                <div class="col-md-12">
                                    <button class="btn btn-info" name="add_product_btn" type="submit">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
            </div>
        </div>
@endsection