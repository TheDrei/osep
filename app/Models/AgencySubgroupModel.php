<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencySubgroupModel extends Model
{
  public $fillable = [
    'agency_subgroup',   
    'agency_group_id',   
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
  protected $table = 'agency_subgroup';


}
