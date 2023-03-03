<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDesignationModel extends Model
{
  public $fillable = [
    'project_designation', 
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
  protected $table = 'project_designation';


}
