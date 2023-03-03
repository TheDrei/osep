<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationProvinceModel extends Model
{
  public $fillable = [
    'province',   
    'region_id',   
    'area_code',    
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
  protected $table = 'location_province';


}
