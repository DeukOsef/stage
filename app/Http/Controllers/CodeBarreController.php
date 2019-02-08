<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeBarreController extends Controller
{
    public function barcode(Request $request){

        $dataNom =  \Session::get('dataNom');
        return view('codeBarre')->with('dataNom', $dataNom);
    }
}
