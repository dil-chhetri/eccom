<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function showOrder(){
        if(session('user')['is_admin']==='YES'){
            $orders = Order::where('order_status','=','PENDING')
            ->get();
            $data = compact('orders');
            return view ('ecommerce.admin.view-orders')->with($data);
        }else{
        $orders = Order::where('user_id',session('user')['user_id'])
        ->where('order_status','=','PENDING')
        ->get();;
        $data = compact('orders');
        return view('ecommerce.main.orders-view')->with($data);
        }
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
            if(session('user')['is_admin']==='YES'){
        $orderItems = DB::table('order_items')
        ->select('order_items.quantity as order_item_quantity','order_items.order_items_id','order_items.product_id','products.product_name','products.price','products.product_id','products.images')
        ->leftJoin('products', 'products.product_id','=','order_items.product_id')
        ->where('order_id',$id)
        ->get();
        $user = User::where('user_id',$order->user_id)->first();
        $address = Address::where('user_id',$order->user_id)->first();
        $data = compact('order', 'orderItems','address','user');
        return view('ecommerce.admin.order-view')->with($data);
            }else{
                $orderItems = DB::table('order_items')
                ->select('order_items.quantity as order_item_quantity','order_items.order_items_id','order_items.product_id','products.product_name','products.price','products.product_id','products.images')
                ->leftJoin('products', 'products.product_id','=','order_items.product_id')
                ->where('order_id',$id)
                ->get();
                $user = User::where('user_id',$order->user_id)->first();
        
                $address = Address::where('user_id',$order->user_id)->first();
                $data = compact('order', 'orderItems','address','user');

                return view('ecommerce.main.order-view')->with($data);
            }
        }else{
            return redirect()->back()->with('Error:','Invalid order');
            
        }
        }catch(Exception $e){
            return redirect()->back()->with('Error:'.$e->getMessage());
        }

    }

    public function cancleOrder($id){
        try{
        $order = Order::find($id)->first();
        if(!is_null($order)){
           $orderItems =  OrderItem::where('order_id',$id)->get();
           OrderItem::where('order_id',$id)->delete();
           foreach($orderItems as $item){
           $product = Product::where('product_id',$item->product_id)->first();
           $product->quantity = $product->quantity + $item->quantity;
           $product->save();
           } 
          
           if(session('user')['is_admin']){
                $order->order_status = 'CANCELLED BY ADMIN';
            }else{
            $order->order_status = 'CANCELLED';
            }
            $order->save();
            return redirect()->back()->with('success','Order Cancelled');
        }else{
            return redirect()->back()->with('error','Invalid order');
        }
        }catch(Exception $e){
            return  redirect()->back()->with('error','Error:'.$e->getMessage());
        }
    }

    public function updateOrder($id){
        $order = Order::find($id)->first();
        if(!is_null($order)){
        $order->order_status = 'COMPLETED';
        $order->save();
        return redirect('/orders-view')->with('success','Order Updated');
        }else{
            return redirect()->with('Error','Invalid order');
        }
    }


}
