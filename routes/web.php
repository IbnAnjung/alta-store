<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|

$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/
/**
 * Route Group Category
 */
$router->group(['prefix' => 'category', 'middleware' => 'guest'], function() use($router){
    $router->get('/', ['as' => '', 'uses' => 'CategoryController@getAllCategory']);
    $router->get('{idCategory}/products', ['as' => '.products', 'uses'=> 'CategoryController@getCategoryProducts']);
});

/**
 * Route Group Product
 */
$router->group(['prefix'=>'product', 'middleware'=>'guest'], function() use($router){
    $router->get('/', ['as'=>'', 'uses'=> 'ProductController@getAllProducts']);
    $router->get('{idProduct}', ['as'=>'', 'uses'=> 'ProductController@getProduct']);
});

/**
 * Route Group Cart
 */
$router->group(['prefix' => 'cart', 'middleware'=> 'guest'], function() use($router){
    $router->get('/', ['as' => 'cart', 'uses' => 'CartController@getCartProducts']);
    $router->post('store', ['as' => 'store', 'uses' => 'CartController@storeProductToCart']);
    $router->patch('update/{productId}', ['as' => 'update-product', 'uses' => 'CartController@updateProductCart']);
    $router->delete('delete/{productId}', ['as'=>'delete-product', 'uses' => 'CartController@deleteProductFromCart']);
});


