<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    //
    public function checkoutItems(){
        if(session('user')){
            $cartProducts = DB::table('carts')
            ->select('carts.quantity as cart_quantity','carts.cart_id','products.product_name as product_name','products.price','products.images')
            ->leftJoin('products','products.product_id', '=', 'carts.product_id')
            ->where('carts.user_id','=', session('user')['user_id'])
            ->get();
            $address = Address::where('user_id',session('user')['user_id'])->first();
            $item = count($cartProducts);
            $data = compact('cartProducts','item','address');
            return view('ecommerce.main.checkout')->with($data);
        }else{
            return redirect('/login');
    
        }
    }


    public function placeOrder(OrderRequest $request){

       try{
        $orderItems = DB::table('carts')
        ->select('carts.quantity as cart_quantity','carts.cart_id','products.product_name as product_name','products.price','products.product_id','products.images')
        ->leftJoin('products','products.product_id', '=', 'carts.product_id')
        ->where('carts.user_id','=', session('user')['user_id'])
        ->get();
        $totalPrice = 0;
        foreach($orderItems as $item){
            $totalPrice += $item->price * $item->cart_quantity;
        }
        // echo "<pre>";
        // print_r($orderItems->toArray());
        $order = new Order();
        $order->user_id = session('user')['user_id'];
        $address = [$request['street_address'],$request['city'],$request['state'],$request['zip_code'],$request['country']];
        $order->shipping_address=implode('|',$address);
        $order->total_price = $totalPrice;
        if($request['cardPayment']){
        $order->payment_method = 'CARD';
        }else{
        $order->payment_method = 'CASH';
        }
        $order->save();
        // echo 'done';
        $orderId = $order->order_id;
        echo $orderId;
        foreach($orderItems as $items){
            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->product_id = $items->product_id;
            $orderItem->quantity = $items->cart_quantity;
            $orderItem->subtotal_price = $items->cart_quantity* $items->price;
            $orderItem->save();
            $p_id = $orderItem->product_id;
            $product = Product::where('product_id',$p_id)->first();
            $product->quantity = $product->quantity - $orderItem->quantity;
            $product->save();
        }
        // echo 'done order_items';
        $checkAddress = Address::where('user_id','=',session('user')['user_id'])->first();
        if(is_null($checkAddress)){
        $addresses = new Address();
        $addresses->user_id = session('user')['user_id'];
        $addresses->street_address = $request['street_address'];
        $addresses->city = $request['city'];
        $addresses->state = $request['state'];
        $addresses->zip_code = $request['zip_code'];
        $addresses->country = $request['country'];
        $addresses->save();
        // echo "address saved";
        $user = User::where('user_id',session('user')['user_id'])->first();
        if(is_null($user->shipping_address)){
            $user->shipping_address = implode('|',$address);
            $user->save();
            // echo "User address acquired";
        }
        }else{
            $addresses = Address::where('user_id','=',session('user')['user_id'])->first();
            $addresses->street_address = $request['street_address'];
            $addresses->city = $request['city'];
            $addresses->state = $request['state'];
            $addresses->zip_code = $request['zip_code'];
            $addresses->country = $request['country'];
            $addresses->save();
            // echo "address updated";
            $user = User::where('user_id',session('user')['user_id'])->first();
            $user->shipping_address = implode('|',$address);
            $user->save();
            echo "User address updated";
        
        }

      $cart = Cart::where('user_id','=',session('user')['user_id'])->delete();
    //   echo "Deleted from cart";
    if($request['cardPayment']){
        $total = $request['total'];
        $productNames = $request['productname'];
        $request->session()->flash('total', $total);
       $request->session()->flash('productNames', serialize($productNames));
        return redirect('/session');
    }else{
        return redirect()->back()->with('success','Order placed');
    }
      

       }catch(Exception $e){
        return redirect()->back()->with('error','Error placing order'.$e->getMessage());

       }
    }
}
