<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class MasterController extends Controller
{
    public function adminDosenList(Request $request) {
        return view('admin.dosen');
    }
    public function adminDosenTambah(Request $request) {
        return view('dashboard');
    }

    public function adminDosenEdit(Request $request) {
        return view('dashboard');
    }

    public function adminDosenDelete(Request $request) {
        return view('dashboard');
    }


    public function adminMahasiswaList(Request $request) {
        return view('admin.mahasiswa');
    }

    public function adminMahasiswaTambah(Request $request) {
        return view('dashboard');
    }

    public function adminMahasiswaEdit(Request $request) {
        return view('dashboard');
    }

    public function adminMahasiswaDelete(Request $request) {
        return view('dashboard');
    }



}
