<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTypeGroupModel extends Model
{
  public $fillable = [
    'document_type_group', 
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
  protected $table = 'document_type_group';


}
