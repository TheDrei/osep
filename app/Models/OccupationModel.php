<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccupationModel extends Model
{
  public $fillable = [
    'occupation',
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
  protected $table = 'occupation';


}
