<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SysUsers extends Authenticatable
{
 	protected $table = "sys_users";
	protected $primaryKey = 'user_id';
	public $timestamps = false;

    protected $fillable = [
        'email', 'password', 'verification', 'deleted_at'
    ];
	
	protected $hidden = [
        'password', 'remember_token',
    ];
    
	public function role()
	{
		return $this->hasOne('App\Models\SysRoles', 'role_id');
	}	
}
