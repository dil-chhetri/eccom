<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function checkout()
    {
        return view('checkout');
    }
 
    public function session(Request $request)
    {
   
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
 
        $productname = $request->get('productname');
        foreach($productname  as $item){
            $p_name = implode('|',$productname);
        }
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";
 
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'npr',
                        'product_data' => [
                            "name" => $p_name,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout.items'),
        ]);
 
        return redirect()->away($session->url);
    }
 
    public function success()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }
}
