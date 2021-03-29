<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\MstDosenPengampu;

class DashboardController extends Controller
{
    public function index(Request $request) {
        return view('dashboard');
    }

    public function search(Request $input)
    {
        $request = $input->all();

        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();

        $keyword = $request["keyword"];

        if( $keyword<> "" ){
            $query =  str_replace(" ", "%20",  $keyword);
            $json=file_get_contents("http://localhost:5000/search?q=$query");

            $data = json_decode($json, true);
            if(empty($data)) {
                $ret->data = array();
            } else {
                $ret->data = $data[0]['details'];
            }
            
        } else {
            $ret->data = array();
        }

        return \Response::json($ret,200);
    }
}
