<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencyGroupModel extends Model
{
  public $fillable = [
    'agency_group',
    'agency_group_description',
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
  protected $table = 'agency_group';


}
