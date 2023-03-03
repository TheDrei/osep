<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityProductModel extends Model
{
  public $fillable = [
    'commodity_id',   
    'product_id',   
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
  protected $table = 'commodity_product';


}
