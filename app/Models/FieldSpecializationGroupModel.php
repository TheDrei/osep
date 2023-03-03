<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldSpecializationGroupModel extends Model
{
  public $fillable = [
    'field_of_specialization_group',  
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
  protected $table = 'field_of_specialization_group';


}
