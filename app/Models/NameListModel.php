<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NameListModel extends Model
{
  public $fillable = [
    'last_name', 
    'first_name', 
    'middle_name', 
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
  protected $table = 'name_list';


}
