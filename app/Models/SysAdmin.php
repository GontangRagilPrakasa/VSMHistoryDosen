<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysAdmin extends Model
{
 	protected $table = "sys_admin";
	protected $primaryKey = "admin_id";
	public $incrementing = true;
}
