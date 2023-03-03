<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetTypeModel extends Model
{
  public $fillable = [
    'budget_type',
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
  protected $table = 'budget_type';


}
