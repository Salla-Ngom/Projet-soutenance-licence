<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tp;

class tpController extends Controller
{
    public function tp($id){
        $tp = tp::findOrFail($id);
        return view('EspaceTp',compact('tp'));
    }
}
