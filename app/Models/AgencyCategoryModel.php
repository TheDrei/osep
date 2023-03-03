<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencyCategoryModel extends Model
{
  public $fillable = [
    'agency_category',
    'agency_category_acronym',
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
  protected $table = 'agency_category';


}
