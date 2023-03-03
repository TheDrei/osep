<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageModel extends Model
{
  public $fillable = [
    'language', 
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
  protected $table = 'languages';


}
