<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstSkripsiLog extends Model
{
    protected $table = "mst_skripsi_log";
	protected $primaryKey = "skripsi_log_id";
	public $incrementing = true;
}
