<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientTypeModel extends Model
{
  public $fillable = [
    'client_type', 
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
  protected $table = 'client_type';


}
