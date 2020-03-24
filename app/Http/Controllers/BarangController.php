<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function barang(){
        $data = "Data All Book";
        return response()->json($data);
    }
    public function barangAuth() {
        $data = "Welcome " . Auth::user()->name;
        return response()->json($data);
    }
}
