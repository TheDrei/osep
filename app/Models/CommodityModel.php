<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityModel extends Model
{
  public $fillable = [
    'commodity',
    'commodity_specific_id',
    'commodity_individual_id',
    'commodity_group_id',
    'project_sector_id',
    'indicator',
    'status',   
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
  protected $table = 'commodity';


}
