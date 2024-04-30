<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $categories_home = Category::with('movie')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('pages.home', compact('categories', 'genres', 'countries', 'categories_home'));
    }

    public function category($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $cate_slug = Category::where('slug', $slug)->first(); 
        return view('pages.category', compact('categories', 'genres', 'countries', 'cate_slug'));
    }  

    public function genre($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $genre_slug = Genre::where('slug', $slug)->first(); 
        return view('pages.genre', compact('categories', 'genres', 'countries', 'genre_slug'));
    } 
    
    public function country($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $country_slug = Country::where('slug', $slug)->first(); 
        return view('pages.country', compact('categories', 'genres', 'countries', 'country_slug'));
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