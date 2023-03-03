<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsortiumTypeModel extends Model
{
  public $fillable = [
    'consortium_type', 
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
  protected $table = 'consortium_type';


}
