<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsortiumModel extends Model
{
  public $fillable = [
    'consortium', 
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
  protected $table = 'consortium';


}
