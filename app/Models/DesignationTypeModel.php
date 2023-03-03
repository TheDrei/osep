<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignationTypeModel extends Model
{
  public $fillable = [
    'designation_type',
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
  protected $table = 'designation_type';


}
