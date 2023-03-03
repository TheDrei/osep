<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationMajorFieldModel extends Model
{
  public $fillable = [
    'education_major_field',
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
  protected $table = 'education_major_field';


}
