<?php

namespace MakersVault\Http\Controllers;

use Illuminate\Http\Request;

use MakersVault\Http\Requests;
use Auth;
use MakersVault\User;
use MakersVault\Product;
use MakersVault\Order;
use Omnipay\Omnipay;

class OrderController extends Controller
{
    public function store(Request $request)
    {

      if (Auth::check()) {
        $user = Auth::user();
    } else {
      $userSearch = User::where('email', $request->email)->first();

      if(! $userSearch ) {
        $user = User::create([
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'email' => $request->email,
          'password' => bcrypt($request->email),

        ]);
      }
      else
      {
        $user = $userSearch;
      }
    }





      $product = Product::find($request->product_id);

      $gateway = Omnipay::create('Stripe');

      $token = $request->stripeToken;

      //dd($token);

      $params = [
        'amount' => '20.00',
        'currency' => 'USD',
        'token' => $token,
        'payment_type' => 'stripe',
        'receipt_email' => $user->email,
        'description' => $product->name,

      ];
        $gateway->setApiKey(env('STRIPE_SECRET'));

        $payment = $gateway->purchase($params);

        $data = $payment->getData();

        //dd($data);

        $data['receipt_email'] = $user->email;
        $data['metadata'] = ['email' => $user->email, 'user_id' => $user->id];

        $response = $payment->sendData($data);

        //dd($response);

        if ($response->isSuccessful()) {
          $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_method' => 'stripe',
            'amount' => '20.00',
          ]);

          return redirect('thanks/'.$product->id);
        } else {
          return redirect('/')->withErrors([$response->getMessage()]);
        }
    }
    public function receipt($id)
    {
      $product = Product::find($id);

      return view('order/receipt', compact('product'));
    }
}
