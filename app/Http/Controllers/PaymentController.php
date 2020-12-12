<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;

class PaymentController extends Controller
{
    
  /**
   * fungsi ini untuk menerima input konfirmasi payment
   * 
   * @param Illuminate\Http\Request $request
   */
  public function paymentConfirmation(Request $request)
  {

    $this->validate($request, [
      'invoice_number' => 'string|max:15',
      'payment_method' => 'string|max:15',
      'payment_date'   => 'required|date|date_format:d-m-Y',
      'payment_total'  => 'required|int',
      'to_account'     => 'required|string|max:25',
    ]);

    $payment = new Payment;
    $payment->invoice_number = $request->get('invoice_number');
    $payment->payment_method = $request->get('payment_method');
    $payment->payment_date   = date("Y-m-d", strtotime($request->get('payment_date')));
    $payment->payment_total  = $request->get('payment_total');
    $payment->to_account    = $request->get('to_account');
    $payment->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Konfirmasi Pembayaran Berhasil, kami akan memvalidasi dan mengupdate data sepecepatnya'
    ]);

  }

  /**
   * fungsi ini untuk melakukan approve pada invoice
   * @param Illuminate\Http\Request $request 
   */
  public function paymentApproving(Request $request, $invoiceId)
  {

    $invoice = Invoice::findOrFail($invoiceId);
   
    if($invoice->paid_on){
      return response()->json([
        'status' => 'error',
        'message' => 'Maaf invoice ini sudah di bayar pada ' . $invoice->paid_on
      ]);
    }

    $invoice->paid_on = date("Y-m-d H:i:s");
    $invoice->save();
    
    return response()->json([
      'status' => 'success',
      'message' => "invoice berhasil diupdate"
    ]);

  }

}
