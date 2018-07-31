<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Log;

class AdminController extends Controller
{
    public function index(){

    }

    public function viewLog(){
        $logs = Log::all();
        return view('layouts.admin.log', ['logs' => $logs]);
    }
}
