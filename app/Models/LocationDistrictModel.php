<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationDistrictModel extends Model
{
  public $fillable = [
    'district',   
    'district_number',  
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
  protected $table = 'location_district';


}
