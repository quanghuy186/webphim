<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->get();
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $categories_home = Category::with('movie')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('pages.home', compact('categories', 'genres', 'countries', 'categories_home', 'movie_hot'));
    }

    public function category($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $cate_slug = Category::where('slug', $slug)->first(); 
        $movie = Movie::where('category_id', $cate_slug->id)->paginate(40);
        return view('pages.category', compact('categories', 'genres', 'countries', 'cate_slug', 'movie'));
    }  

    public function genre($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $genre_slug = Genre::where('slug', $slug)->first(); 
        $movie = Movie::where('genre_id', $genre_slug->id)->paginate(2);
        return view('pages.genre', compact('categories', 'genres', 'countries', 'genre_slug', 'movie'));
    } 
    
    public function country($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $country_slug = Country::where('slug', $slug)->first(); 
        $movie = Movie::where('country_id', $country_slug->id)->paginate(40);
        return view('pages.country', compact('categories', 'genres', 'countries', 'country_slug', 'movie'));
    }

    public function episode(){
        return view('pages.episode');
    } 

    public function movie($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $movie = Movie::with('category', 'genre', 'country')->where('slug', $slug)->where('status', 1)->first();
        return view('pages.movie', compact('genres', 'countries', 'categories', 'movie'));
    }

    public function watch(){
        return view('pages.watch');
    }
}