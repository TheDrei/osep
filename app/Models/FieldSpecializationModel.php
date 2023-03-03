<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldSpecializationModel extends Model
{
  public $fillable = [
    'field_of_specialization',
    'field_of_specialization_group_id',   
    'sector_id',   
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
  protected $table = 'field_of_specialization';


}
