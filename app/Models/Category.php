<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{

  use HasFactory;
  
  /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
      'created_at', 'updated_at'
    ];

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