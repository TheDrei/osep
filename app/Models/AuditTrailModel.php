<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrailModel extends Model
{
  public $fillable = [
    'user_id',
    'action_id',
    'module_id',
    'audit_item ',
    'before_action',
    'after_action',
    'datetime',
    'ip_address',
    'host_name'
  ];
  /**
   * The table associated with the model.
   *
   * @var string
   */
}
