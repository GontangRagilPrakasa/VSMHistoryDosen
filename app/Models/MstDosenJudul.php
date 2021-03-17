<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstDosenJudul extends Model
{
    protected $table = "mst_dosen_judul";
	protected $primaryKey = "dosen_judul_id";
	public $incrementing = true;
}
