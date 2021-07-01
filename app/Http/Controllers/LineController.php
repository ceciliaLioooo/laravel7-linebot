<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class LineController extends Controller
{
    public function index(Request $request){
        return response('ok','200');
    }
}
