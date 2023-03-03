<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankingModel extends Model
{
  public $fillable = [
    'ranking', 
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
  protected $table = 'ranking';


}
