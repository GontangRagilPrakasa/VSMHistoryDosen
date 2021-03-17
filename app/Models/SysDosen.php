<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysDosen extends Model
{
 	protected $table = "sys_dosen";
	protected $primaryKey = "dosen_id";
	public $incrementing = true;
}
