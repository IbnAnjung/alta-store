<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GuestController;
use App\Models\Checkout;
use App\Models\Product;

class CheckoutController extends Controller
{
  
  /**
   * fungsi ini untuk menghendle request checkout dari cart
   * qty barang diambil dari dalam cart
   * id barang yang masuk harus terdaftar pada cart
   * 
   * @param Illuminate\Http\Request $request
   * 
   * @return Response
   */
  public function checkoutFromCart(Request $request)
  {

    $this->validate($request, [
      'product_id.*' => 'int|min:1',
      'city' => 'string|max:25',
      'phone' => 'string|max:14',
      'address' => 'string|max:254' 
    ]);
    
    $guest = (new GuestController)->getGuest($request);
    $cart = $guest->cart;
    $cartProducts = $cart->products;
    $availableProducts = array_column($cartProducts->toArray(), 'id');

    foreach($request->get('product_id') as $productId){

      if(!in_array($productId, $availableProducts)){

        return response()->json([
          'status' => 'error',
          'message' => "product ini tidak ada di dalam cart kamu",
          'product' => Product::findOrFail($productId)
        ]);

      }

    }

    $checkout = new Checkout;
    $checkout->guest_id = $guest->id;
    $checkout->city = $request->get('city');
    $checkout->phone= $request->get('phone');
    $checkout->address= $request->get('address');
    $checkout->save();

    $checkoutProducts = [];
    foreach($cartProducts as $product){

      if(in_array($product->id, $request->get('product_id'))){
        $checkoutProducts[$product->id] = [
          'qty' => $product->pivot->qty,
          'price' => $product->price,
          'weight' => $product->weight,
          'description' => $product->description
        ];
      }

    }

    $checkoutProducts;
    
    $checkout->products()->sync($checkoutProducts);

    return response()->json([
      'true' => 'success',
      'data' => $checkout
    ]);

  }

}
