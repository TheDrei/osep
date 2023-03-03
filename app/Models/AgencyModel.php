<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencyModel extends Model
{
  public $fillable = [
    'agency',
    'acronym',
    'street',
    'barangay_id',
    'municipality_id',
    'province_id',    
    'telno',
    'faxno',
    'email',
    'website',
    'head_agency_id',
    'consortium_type_id',
    'agency_category_id',
    'agency_class_id',   
    'agency_group_id',
    'agency_subgroup_id',
    'agency_type_id',
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
  protected $table = 'agency';


}
