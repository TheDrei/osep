<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignationModel extends Model
{
  public $fillable = [
    'designation',
    'abbreviation',
    'designation_type_id',
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
  protected $table = 'designation';


}
