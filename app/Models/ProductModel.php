<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
  public $fillable = [
    'product', 
    'tags',
    'is_verified',
    'is_active',
    'is_deleted'
  ];
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'products';


}
