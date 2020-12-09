<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{

  use HasFactory;
  
  /**
   * one to one invers with checkout
   * 
   * @return Eloquent 
   */
  public function checkout()
  {

    return $this->belongsTo(Checkout::class);

  }

}