<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard');
    }
}
