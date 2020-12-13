<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GuestController;
use App\Models\Invoice;
use App\Models\Checkout;

class InvoiceController extends Controller
{
    
  /**
   * fungsi untuk membuat invoice
   * 
   * @param Illuminate\Http\Request $request
   * @param int checkoutId
   * 
   * @return Response
   */
  public function createNewInvoice(Request $request, $checkoutId)
  {

    $checkout = Checkout::findOrFail($checkoutId);
    $guest = (new GuestController)->getGuest($request);

    if($guest->id != $checkout->guest_id){

      return response()->json([
        "status" => 'error',
        'message' => 'maaf checkout ini bukan milik kamu'
      ], 500);

    }

    if($checkout->invoice) {
      return response()->json([
        "status" => "error",
        "message" => "maaf checkout ini sudah memiliki invoice",
        "data" => $checkout->invoice
      ], 500);
    }

    $number = date("ymdhi") . sprintf("%03d", rand(100, 50000));

    $invoice = new Invoice;
    $invoice->number = $number;
    $invoice->checkout_id = $checkout->id;
    $invoice->save();

    return response()->json([
      'status' => 'success',
      'message' => 'invoice kamu berhasil di buat',
      'data' => $invoice
    ]);

  }

  /**
   * fungsi untuk melihat invoice
   * 
   * @param Request $request
   * @param int $invoiceId
   * 
   * @return Response
   */
  public function getInvoice(Request $request, $invoiceId)
  {

    $invoice = Invoice::findOrFail($invoiceId);
    $guest = (new GuestController)->getGuest($request);

    if($invoice->checkout->guest->id !== $guest->id && $request->header('x-admin-token') == ''){
      return response()->json([
        'status' => 'error',
        'message' => 'maaf invoice yang kamu cari tidak ketemu'
      ]);
    }

    $totalInvoice = $invoice->checkout->products->sum(function($product){
      return $product->pivot->qty * $product->pivot->price;
    });
    

    return response()->json([
      'status' => 'success',
      'data' => [
        'invoice' => $invoice,
        'totalInvoice' => $totalInvoice
      ]
    ]);
    

  }

}
