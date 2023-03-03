<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationGroupModel extends Model
{
  public $fillable = [
    'publication_group', 
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
  protected $table = 'publication_group';


}
