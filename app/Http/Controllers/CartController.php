<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function index(){
        if(session('user')){
        $cartProducts = DB::table('carts')
        ->select('carts.quantity as cart_quantity','carts.cart_id','products.product_name as product_name','products.price','products.images')
        ->leftJoin('products','products.product_id', '=', 'carts.product_id')
        ->where('carts.user_id','=', session('user')['user_id'])
        ->get();
        $item = count($cartProducts);
        $data = compact('cartProducts','item');
        return view('ecommerce.main.cart')->with($data);
    }else{
        return view('ecommerce.main.cart');

    }
}

    public function updateCart(Request $request,$id){
        try{
            $cart = Cart::find($id);
            if(!is_null($cart)){
                $cart->quantity = $request['quantity'];
                $cart->save();
              return response()->json(['data' => $cart]);
            }else{
                return response()->json([]);
            }
        }
        catch(Exception $e){
            return response()->json([$e->getMessage()]);

        }
    
    }


    public function addToCart(Request $request){
        if(!is_null(session('user'))){
        try{
        $user_id = session('user')['user_id'];
        $cartProductExist = Cart::where('product_id','=',$request['product_id'])
        ->where('user_id','=',session('user')['user_id'])->get();
        if(count($cartProductExist)>0){
            return response([
                'message' => 'Product already exist in cart'
            ], 'exist');
        }else{
        $cart = new Cart();
        $cart->product_id = $request['product_id'];
        $cart->quantity = $request['quantity'];
        $cart->user_id = $user_id;
        $cart->save();
        return response([
            'message' => 'product added to cart'
        ]);
        }
        }catch(Exception $e){
            return response([
                'message' => 'Error'.$e->getMessage()
            ],500);
        }
    }else{
        return response([
            'message' => 'Login to continue'
        ],401);
    }
}

public function deleteCartItem($id){
try{
    $cart = Cart::find($id);
    if(!is_null($cart)){
        $cart->delete();
        return response(['message'=>'Product Deleted Successfully']);
    }else{
        return response(['message'=>'Invalid Cart Item']);
    }
}catch(Exception $e){
    return response(['error'=>'Error'.$e->getMessage()]);
}
}
}
