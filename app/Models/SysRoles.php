<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysRoles extends Model
{
 	protected $table = "sys_roles";
	protected $primaryKey = "role_id";
	public $incrementing = true;
}
