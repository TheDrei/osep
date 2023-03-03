<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
  public $fillable = [
    'employee_code',
    'user_role_id',
    'email_address',
    'first_name',
    'middle_name',
    'last_name',
    'agency_id',
    'username',
    'password',
    'wants_notif',
    'is_pcaarrd',
    'is_logged_in',
    'is_active',
    'is_deleted'
  ];
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'users';
}
