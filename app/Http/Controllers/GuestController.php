<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Guest;

class GuestController extends Controller
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

  public function storeNewGuest()
  {

    $guest = new Guest;
    $guest->token = md5(\random_bytes(10));
    $guest->save();

    $guest->cart()->create();

    return response()->json([
      'guest_token' => $guest->token,
      'description' => 'gunakan token ini pada headers(x-guest-token) untuk setiap request'
    ]);

  }

  public function getGuest(Request $request)
  {

    $guest = Guest::whereToken($request->header('x-guest-token'))->first();

    return $guest ;

  }
}
