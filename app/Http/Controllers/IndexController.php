<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class IndexController extends Controller
{
    public function home(){
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $categories_home = Category::with('movie')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('pages.home', compact('categories', 'genres', 'countries', 'categories_home', 'movie_hot', 'movie_hot_sidebar', 'hot_trailer'));
    }

    public function category($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $cate_slug = Category::where('slug', $slug)->first(); 
        $movie = Movie::where('category_id', $cate_slug->id)->paginate(40);
        return view('pages.category', compact('categories', 'genres', 'countries', 'cate_slug', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 

    public function year($year){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $year = $year; 
        $movie = Movie::where('year', $year)->orderBy('updated_at', 'DESC')->paginate(40);
        return view('pages.year', compact('categories', 'genres', 'countries', 'year', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 

    public function tag($tag){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $tag = $tag; 
        $movie = Movie::where('tags','LIKE', '%'.$tag.'%')->orderBy('updated_at', 'DESC')->paginate(40);
        return view('pages.tag', compact('categories', 'genres', 'countries', 'tag', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 

    public function search(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
            $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
            $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
            $genres = Genre::orderBy('id', 'desc')->get();
            $countries = Country::orderBy('id', 'desc')->get();
            $movie = Movie::where('title', 'LIKE', '%'.$search.'%')->paginate(40);
            return view('pages.search', compact('categories', 'genres', 'countries', 'search', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
        }else{
            return redirect()->to('/');
        }
    }

    public function genre($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $genre_slug = Genre::where('slug', $slug)->first(); 
        //lay ra nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $movie_gen = [];
        foreach ($movie_genre as $movi) {
            $movie_gen[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id',$movie_gen)->paginate(12);
        return view('pages.genre', compact('categories', 'genres', 'countries', 'genre_slug', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 
    
    public function country($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $country_slug = Country::where('slug', $slug)->first(); 
        $movie = Movie::where('country_id', $country_slug->id)->paginate(40);
        return view('pages.country', compact('categories', 'genres', 'countries', 'country_slug', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    }

    public function episode(){
        return view('pages.episode');
    } 

    public function movie($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $movie = Movie::with('category', 'genre', 'country')->where('slug', $slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        return view('pages.movie', compact('genres', 'countries', 'categories', 'movie', 'movie_related', 'movie_hot_sidebar', 'hot_trailer'));
    }
 
    public function watch(){
        return view('pages.watch');
    }
}