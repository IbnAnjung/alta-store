<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

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