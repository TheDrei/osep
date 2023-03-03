<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencyClassModel extends Model
{
  public $fillable = [
    'agency_class',
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
  protected $table = 'agency_class';


}
