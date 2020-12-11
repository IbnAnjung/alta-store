<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * show all categories
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Response
     */
    public function getAllCategory(Request $request)
    {

      $this->validate($request, [
        'page' => 'int|min:1',
        'limit' => 'int|min:1'
      ]);
      
      $limit = $request->get('limit');
      $page  = $request->get('page', 1);

      $totalCategory = Category::count();
      $categories = Category::when($limit, function($categories) use($limit, $page){
        $categories->skip(($page-1)*$limit)->take($limit);
      })
      ->get();

      return response()->json([
        'status'     => 'success', 
        'data'       => $categories,
        'total_data' => $totalCategory,
        'page'       => $page,
      ], 200);

    }
    
    /**
     * show all products category
     * 
     * @param int $idCategory
     * @param Illuminate\Http\Request $request
     * 
     * @return Response
     */
    public function getCategoryProducts(Request $request, $idCategory)
    {

      $this->validate($request, [
        'limit' => 'int', 
        'page' => 'int'
      ]);
      
      $limit = $request->get('limit');
      $page  = $request->get('page', 1);

      $category = Category::findOrFail($idCategory);
      $totalProducts = $category->products->count();
      $products = $category->products()
        ->when($limit, function($categories) use($limit, $page){
          $categories->skip(($page-1)*$limit)->take($limit);
        })
        ->get();
      
      return response()->json([
        'status'     => 'success', 
        'data'       => $products,
        'total_data' => $totalProducts,
        'page'       => $page,
      ], 200);
    }
}
