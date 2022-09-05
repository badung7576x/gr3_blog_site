<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    

    public function home()
    {
        return view('user.home');
    }

    public function detail()
    {
        return view('user.article');
    }
}
