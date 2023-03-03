<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllProjectsModel extends Model
{
  protected $connection = 'palihan_fed';
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'projects';


}
