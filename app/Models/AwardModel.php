<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardModel extends Model
{
  public $fillable = [
    'award', 
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
  protected $table = 'awards';


}
