<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next, $role_id)
    {	
    	$explode = explode("|", $role_id);
    	foreach ($explode as $value) {
    		$role_id_new[] = $value;
    	}
    	
		if(!in_array(Auth::User()->role, $role_id_new)){
			return abort(401);
		}
		
        return $next($request);
    }
}
