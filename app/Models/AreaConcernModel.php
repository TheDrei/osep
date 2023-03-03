<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaConcernModel extends Model
{
  public $fillable = [
    'area_concern', 
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
  protected $table = 'area_concern';


}
