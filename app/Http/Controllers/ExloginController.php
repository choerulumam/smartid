<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExloginController extends Controller
{
    public function show(Request $request) {
    	$error = $request->error;
    	$mac = $request->mac;
    	$ip = $request->ip;
    	$chapid = $request->chap-id;
    	return view('mikrotik');
    }
}
