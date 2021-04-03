<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstFakultas extends Model
{
    protected $table = "mst_fakultas";
	protected $primaryKey = "fakultas_id";
	public $incrementing = true;
}
