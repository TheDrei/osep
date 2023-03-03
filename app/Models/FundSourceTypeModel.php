<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundSourceTypeModel extends Model
{
  public $fillable = [
    'fund_source_type',
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
  protected $table = 'fund_source_type';


}
