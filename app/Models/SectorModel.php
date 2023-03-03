<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectorModel extends Model
{
  public $fillable = [
    'sector', 
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
  protected $table = 'sectors';


}
