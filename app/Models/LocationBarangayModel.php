<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationBarangayModel extends Model
{
  public $fillable = [
    'barangay',
    'municipality_id',   
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
  protected $table = 'location_barangay';


}
