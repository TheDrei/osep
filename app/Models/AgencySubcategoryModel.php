<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencySubcategoryModel extends Model
{
  public $fillable = [
    'agency_subcategory',
    'agency_subcategory_acronym',
    'agency_category_id',
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
  protected $table = 'agency_subcategory';


}
