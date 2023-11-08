@extends('ecommerce.admin.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main-contain')
<div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Category</h4>
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
                                    <label class="mb-0">Category Name</label>
                                    <input type="text" name="category_name"  class="form-control mb-2" placeholder="Enter category name" value="{{$category->category_name}}">
                                </div>
                                
                                    <!-- <label for="">Enter or Select Parent Category</label> -->
                                <div class="col-md-3">
                                    <label class="mb-0">Parent Category</label>
                                    <input type="text" name="parent_category_entered" value="{{$category->parent_category}}"  class="form-control mb-2" placeholder="Enter new parent category">
                                </div>   


                              
                                <div class="col-md-3">
                                    <label class="mb-0">Select existing category</label>
                                        <select name="parent_category_selected" class="form-select mb-2" >
                                                <option value="{{$category->parent_category}}" selected>{{$category->parent_category}}</option>
                                                @foreach($categories as $item)
                                                <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                                                <option value="{{$item->parent_category}}">{{$item->parent_category}}</option>

                                                @endforeach
                                        </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="d-block">Category Image</label>
                                    <img src="{{url('upload/images').'/'.$category->image}}" srcset="" width="100px" height="100px"  class="img" alt="{{$category->image}}">
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="mb-0">Upload Image</label>
                                    <input type="hidden" name="image" value="{{$category->image}}">
                                    <input type="file" name="image" id="" class="form-control mb-2" >
                                </div>


                                
                                <div class="col-md-12">
                                    <button class="btn btn-info" name="add_product_btn" type="submit">Edit Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
            </div>
        </div>
@endsection