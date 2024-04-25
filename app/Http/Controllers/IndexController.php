<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        return view('pages.home');
    }

    public function category(){
        return view('pages.category');
    }  
    
    public function country(){
        return view('pages.country');
    }

    public function episode(){
        return view('pages.episode');
    } 

    public function movie(){
        return view('pages.movie');
    }

    public function watch(){
        return view('pages.watch');
    }
}