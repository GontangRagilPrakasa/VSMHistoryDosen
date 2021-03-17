<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysMahasiswa extends Model
{
 	protected $table = "sys_mahasiswa";
	protected $primaryKey = "mahasiswa_id";
	public $incrementing = true;
}
