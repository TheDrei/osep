<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSectorModel extends Model
{
  public $fillable = [
    'project_sector', 
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
  protected $table = 'project_sectors';


}
