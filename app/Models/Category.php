<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{

  use HasFactory;
  
  /**
   * has many product
   * 
   * @return Eloquent
   */
  public function products()
  {

    return $this->hasMany(Product::class);

  }

}