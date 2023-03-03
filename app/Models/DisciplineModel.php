<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplineModel extends Model
{
  public $fillable = [
    'discipline', 
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
  protected $table = 'discipline';


}
