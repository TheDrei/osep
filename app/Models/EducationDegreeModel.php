<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationDegreeModel extends Model
{
  public $fillable = [
    'education_degree',
    'acronym',  
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
  protected $table = 'education_degree';


}
