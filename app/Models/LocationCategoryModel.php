<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationCategoryModel extends Model
{
  public $fillable = [
    'category',     
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
  protected $table = 'location_category';


}
