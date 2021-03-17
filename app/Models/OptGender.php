<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptGender extends Model
{
    protected $table = "opt_gender";
	protected $primaryKey = "gender_id";
	public $incrementing = true;
}
