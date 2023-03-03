<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationMunicipalityModel extends Model
{
  public $fillable = [
    'municipality',   
    'district_id',   
    'province_id',   
    'name_id',   
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
  protected $table = 'location_municipality';


}
