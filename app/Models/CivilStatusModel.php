<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CivilStatusModel extends Model
{
  public $fillable = [
    'civil_status', 
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
  protected $table = 'civil_status';


}
