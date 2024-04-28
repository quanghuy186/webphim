<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $categories = Category::orderBy('id', 'desc')->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        return view('pages.home', compact('categories', 'genres', 'countries'));
    }

    public function category(){
        return view('pages.category');
    }  

    public function genre(){
        return view('pages.genre');
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