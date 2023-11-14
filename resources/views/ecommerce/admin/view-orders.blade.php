@extends('ecommerce.admin.layouts.main')
@push('title')
<title>view-products</title>
@endpush
@section('main-contain')
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Orders</h4>
                    @if(session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                    @else
                    <p class="text-success">{{ session('success') }}</p>
                    @endisset
                    </div>
                    <div class="card-body" id="products_table">
                        <a href="{{url('/')}}/view-trash" class="btn btn-success">Order History</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Order ID</th>
                                    <th>Address</th>
                                    <th>Total Price</th>
                                    <th>Order Statis</th>
                                    <th>Payment Method</h>
                                    <th>Actions</th>
                                    


                                </tr>
                            </thead>
                            <tbody>
                           @foreach($orders as $item)
                                        <tr>
                                            <td>{{$item->order_id}}</td>

                                            <td>{{$item->shipping_address}}</td>
                                           <td>{{$item->total_price}}</td>
                                            <td>
                                            {{$item->order_status}}
                                            </td>
                                            <td>{{$item->payment_method}}</td>
                                            


                                            <td>
                                                <a href="{{route('order.view',['order_id'=>$item->order_id])}}" class="btn btn-info ">Edit</a>
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