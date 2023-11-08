<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $data = compact('products');
        return view('ecommerce.main.dashboard')->with($data);
    }

    public function register(){
        return view('ecommerce.register');
    }

    public function storeUser(Request $request){

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'phone_number' => 'required|unique:users,phone_number',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'

        ]);
        $user = new User();
        $user -> first_name = $request['first_name'];
        $user -> last_name = $request['last_name'];
        $user -> username = $request['username'];
        $user -> phone_number = $request['phone_number'];
        $user -> email = $request['email'];
        $user -> password = Hash::make($request['password']);
        $user -> save();

        $credentails = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentails)){
            $user = Auth::user();
            $request->session()->put(['user'=>$user]);
            return redirect('/');
        }else{
            return "Error";
        }
        return redirect('/');

    }

    public function login(){
        return view('ecommerce.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password'=> 'required'
        ]);
        $credentails = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($credentails)){
            $user = Auth::user();
            $request->session()->put(['user'=>$user]);
            if(session('user')['is_admin']==="YES"){
                return redirect('/admin');
            }else{
                return redirect()->back()->with('success','Login successful');
            }
        }else{
            return redirect()->back()->with('error','Error with login');

        }
    }

    public function logout(){
        session()->forget('user');
        return redirect('/');
    }
}
