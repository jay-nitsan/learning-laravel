<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Psy\debug;

class BlogController extends Controller
{
    public function list(Request $request){
        debug($request->fullUrl());
        return view('blog.list');
    }
}
