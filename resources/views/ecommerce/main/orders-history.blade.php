@extends('ecommerce.layouts.main')
@push('title')
<title>index</title>
@endpush
@section('main')
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
                 
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Order ID</th>
           
                                    <th>Address</th>
                                    <th>Total Price</th>
                                    <th>Status</h>
                             
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                           @foreach($orders as $item)
                                        <tr>
                                            <td>{{$item->order_id}}</td>


                                           
                                            <td>
                                                @php
                                                $shipping_address = explode('|', $item->shipping_address);
                                                @endphp
                                                @foreach($shipping_address as $address)
                                                <span>{{$address}}</span>
                                                @endforeach
                                            </td>
                                            <td>{{$item->total_price}}</td>
                                            
                                            <td>{{$item->order_status}}</td>
                                          


                                            <td>
                                                <a class="btn btn-info" href="{{route('order.view',['order_id' => $item->order_id])}}">View Order</a>
                                              
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