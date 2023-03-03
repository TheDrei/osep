<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityIndividualModel extends Model
{
  public $fillable = [
    'commodity_individual_id',
    'commodity_group_id',
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
  protected $table = 'commodity_individual';


}
