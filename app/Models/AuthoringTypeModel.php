<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthoringTypeModel extends Model
{
  public $fillable = [
    'authoring_type', 
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
  protected $table = 'authoring_type';


}
