<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationTypeModel extends Model
{
  public $fillable = [
    'location_type',     
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
  protected $table = 'location_type';


}
