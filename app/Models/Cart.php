<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{

  use HasFactory;

  /**
   * many to many with products
   * 
   * @return Eloquent 
   */
  public function products()
  {

    return $this->belongsToMany(Products::class);

  }

  /**
   * one to one invers with guest
   * 
   * @return Eloquent
   */
  public function guest()
  {

    return $this->belongsTo(Guest::class);

  }

}