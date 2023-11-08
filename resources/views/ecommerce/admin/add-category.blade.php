@extends('ecommerce.admin.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main-contain')
<div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/')}}/addCategory" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0">Category Name</label>
                                    <input type="text" name="category_name"  class="form-control mb-2" placeholder="Enter category name">
                                </div>
                                
                                    <!-- <label for="">Enter or Select Parent Category</label> -->
                                <div class="col-md-3">
                                    <label class="mb-0">Parent Category</label>
                                    <input type="text" name="parent_category_entered"  class="form-control mb-2" placeholder="Enter new parent category">
                                </div>   

                              
                                <div class="col-md-3">
                                    <label class="mb-0">Select existing category</label>
                                        <select name="parent_category_selected" class="form-select mb-2" >
                                                <option value="" selected>Select Existing Parent Category</option>
                                                @foreach($categories as $item)
                                                <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                                                <option value="{{$item->parent_category}}">{{$item->parent_category}}</option>

                                                @endforeach
                                        </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="mb-0">Upload Image</label>
                                    <input type="file" name="image" id="" class="form-control mb-2" >
                                </div>


                                
                                <div class="col-md-12">
                                    <button class="btn btn-info" name="add_product_btn" type="submit">Add Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
            </div>
        </div>
@endsection