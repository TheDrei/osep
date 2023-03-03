<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityGroupModel extends Model
{
  public $fillable = [
    'commodity_group',
    'project_sector_id',
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
  protected $table = 'commodity_group';


}
