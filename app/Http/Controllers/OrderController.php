<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function showOrder(){
        $orders = Order::where('user_id',session('user')['user_id'])
        ->where('order_status','=','PENDING')
        ->get();;
        $data = compact('orders');
        return view('ecommerce.main.orders-view')->with($data);
    }

    public function orderHistory(){
        $orders = Order::where('user_id',session('user')['user_id'])
        ->where('order_status','=','COMPLETED')
        ->orWhere('order_status','=','CANCELLED')
        ->get();;
        $data = compact('orders');
        return view('ecommerce.main.orders-history')->with($data);
    }

    public function viewOrder($id){
        try{
        $order = Order::where('order_id',$id)->first();
        if(!is_null($order)){
        $orderItems = DB::table('order_items')
        ->select('order_items.quantity as order_item_quantity','order_items.order_items_id','order_items.product_id','products.product_name','products.price','products.product_id','products.images')
        ->leftJoin('products', 'products.product_id','=','order_items.product_id')
        ->where('order_id',$id)
        ->get();

        $address = Address::where('user_id',session('user')['user_id'])->first();
        $data = compact('order', 'orderItems','address');
        return view('ecommerce.main.order-view')->with($data);
        }else{
            return redirect()->back()->with('Error:','Invalid order');
            
        }
        }catch(Exception $e){
            return redirect()->back()->with('Error:'.$e->getMessage());
        }

    }
}
