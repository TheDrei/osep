<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrailModel extends Model
{
  protected $fillable = [
    'user_id',
    'action',
    'module_id',    
    'audit_item',    
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
  protected $table = 'audit_trail';
}
