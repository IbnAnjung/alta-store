<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
  /**
   * fungsi ini untuk menampilkan data products
   * 
   * @param Illuminate\Http\Request $request
   * 
   * @return Response
   */
  public function getAllProducts(Request $request)
  { 

    $this->validate($request, [
      'page' => 'int|min:1',
      'limit' => 'int|min:1'
    ]);

    $limit = $request->get('limit');
    $page  = $request->get('page', 1);

    $totalProduct = Product::count();
    $products = Product::with("category")->when($limit, function($products) use($limit, $page){
      $products->skip(($page-1) * $limit)->take($limit);
    })
    ->get();

    return response()->json([
      'status' => 'success',
      'data' => $products, 
      'total_data' => $totalProduct,
      'page' => $page
    ], 200);
        
  }

  /**
   * fungsi untuk melihat detail product
   * 
   * @param int $idProduct
   * 
   * @return Response
   */
  public function getProduct($idProduct)
  {

    $product = Product::with("category")->findOrFail($idProduct);

    return response()->json([
      'status' => 'success', 
      'data' => $product
    ], 200);

  }
    
}
