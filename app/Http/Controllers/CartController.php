<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GuestController;
use App\Models\Product;
use App\Modesl\Cart;

class CartController extends Controller
{

  /**
   *fungsi ini untuk menampilkan products pada cart 
   *
   * @param Illuminate\Http\Request $request
   * 
   * @return Response  
   */    
  public function getCartProducts(Request $request)
  {
    
    $guest = (new GuestController)->getGuest($request);

    $produtcs = $guest->cart->products()->get();
    
    return response()->json([
      'status' => 'success',
      'data' => $produtcs,
      'total_data' => $produtcs->count(),
    ]);

  }

  /**
   * store new product to cart
   * 
   * @param Illuminate\Http\Request $request
   * 
   * @return Response
   */
  public function storeProductToCart(Request $request)
  {

    $this->validate($request, [
      'qty' => 'int|min:1', 
      'product_id' => 'int|min:1'
    ]);

    $cart = (new GuestController)->getGuest($request)->cart;
    $product = Product::findOrFail($request->get('product_id'));

    $productCart = $cart->products()->where('id', $product->id)->first();
    
    if(!$productCart) {
      
      $cart->products()->attach($product->id, ['qty' => $request->get('qty')]);

    }else{

      $cart->products()->updateExistingPivot($product->id, ['qty' => $productCart->pivot->qty + $request->get('qty')]);

    }

    return response()->json([
      'status' => 'succes', 
    ], 200);
  }

    /**
   * store new product to cart
   * 
   * @param Illuminate\Http\Request $request
   * 
   * @return Response
   */
  public function updateProductCart(Request $request, $productId)
  {

    $this->validate($request, [
      'qty' => 'int|min:1|required', 
    ]);

    $cart = (new GuestController)->getGuest($request)->cart;
    $product = Product::findOrFail($productId);

    $productCart = $cart->products()->where('id', $product->id)->first();
    
    if(!$productCart) {

      return response()->json([
        'status' => 'error',
        'message' => 'product tidak ditemukan pada keranjang kamu'
      ], 500);

    }else{

      $cart->products()->updateExistingPivot($product->id, ['qty'=>$request->get('qty')]);

    }

    return response()->json([
      'status' => 'succes', 
    ], 200);
  }

  /**
   * delete product form cart
   * 
   * @param Illuminate\Http\Request $request
   * @param Int $productId
   * 
   * @return Response
   */
  public function deleteProductFromCart(Request $request, $productId)
  {

    $cart = (new GuestController)->getGuest($request)->cart;
    $product = Product::findOrFail($productId);

    $cart->products()->detach($product->id);

    return response()->json([
      'status' => 'success'
    ], 200);

  }



}
