<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkActivityModel extends Model
{
  public $fillable = [
    'work_activity', 
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
  protected $table = 'work_activity';


}
