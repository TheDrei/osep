<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionCategoryModel extends Model
{
  public $fillable = [
    'position_category',
    'abbreviation',
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
  protected $table = 'position_category';


}
