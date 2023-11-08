@extends('ecommerce.admin.layouts.main')
@push('title')
<title>view-products</title>
@endpush
@section('main-contain')
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Categories</h4>
                    @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                    @else
                    <p class="text-success">{{ session('success') }}</p>
                    @endisset
                    </div>
                    <div class="card-body" id="products_table">
                    <a href="{{url('/')}}/view-trash-category" class="btn btn-success">Trash</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Parent Category</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                           @foreach($categories as $item)
                                        <tr>
                                            <td>{{$item->category_name}}</td>

                                            <td>{{$item->parent_category}}</td>
                                           
                                            <td>
                                                <img src="{{url('upload/images').'/'.$item->image}}" srcset="" width="50px" height="50px"  class="img">
                                            </td>
  

                                            <td>
                                                <a href="{{route('edit.category',['category_id' => $item->category_id ])}}" class="btn btn-info ">Edit</a>
                                              
                                           
                                                <a href="{{route('delete.category',['category_id' => $item->category_id ])}}" class="btn btn-danger ">Delete</a>
                                            
                                                
                                               
                                                
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