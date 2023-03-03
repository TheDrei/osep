<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationStatusModel extends Model
{
  public $fillable = [
    'education_status',
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
  protected $table = 'education_status';


}
