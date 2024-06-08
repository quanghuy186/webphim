<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Caster\RedisCaster;

use function Laravel\Prompts\select;

class IndexController extends Controller
{
    public function home(){
        $movie_hot = Movie::where('movie_hot', 1)->withCount('episode')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $categories_home = Category::with(['movie'=>function($q){ $q->withCount('episode');}])->orderBy('id', 'desc')->where('status', 1)->get();
        return view('pages.home', compact('categories', 'genres', 'countries', 'categories_home', 'movie_hot', 'movie_hot_sidebar', 'hot_trailer'));
    }

    public function category($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $cate_slug = Category::where('slug', $slug)->first(); 
        $movie = Movie::where('category_id', $cate_slug->id)->withCount('episode')->paginate(40);
        return view('pages.category', compact('categories', 'genres', 'countries', 'cate_slug', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 

    public function year($year){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $year = $year; 
        $movie = Movie::where('year', $year)->orderBy('updated_at', 'DESC')->withCount('episode')->paginate(40);
        return view('pages.year', compact('categories', 'genres', 'countries', 'year', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 

    public function tag($tag){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $tag = $tag; 
        $movie = Movie::where('tags','LIKE', '%'.$tag.'%')->withCount('episode')->orderBy('updated_at', 'DESC')->paginate(40);
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
            $movie = Movie::where('title', 'LIKE', '%'.$search.'%')->withCount('episode')->paginate(40);
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
        $movie = Movie::whereIn('id',$movie_gen)->withCount('episode')->paginate(12);
        return view('pages.genre', compact('categories', 'genres', 'countries', 'genre_slug', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
    } 
    
    public function country($slug){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $country_slug = Country::where('slug', $slug)->first(); 
        $movie = Movie::where('country_id', $country_slug->id)->withCount('episode')->paginate(40);
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
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        // lấy ra 3 tập phim mới nhất 
        $episodes = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'DESC')->take(3)->get();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        $episode_first = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        // đếm xem có tổng bao nhiêu tập phim
        $count_episode_movie = Episode::with('movie')->where('movie_id', $movie->id)->count();
        return view('pages.movie', compact('genres', 'countries', 'categories', 'movie', 'movie_related', 'movie_hot_sidebar', 'hot_trailer', 'episodes', 'episode_first', 'count_episode_movie'));
    }
 
    public function watch($slug, $tap){
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->withCount('episode')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        if(isset($tap)){
            $tapphim = $tap;
            $tapphim = substr($tap, 4,20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }else{
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }

        return view('pages.watch', compact('tapphim','genres', 'countries', 'categories', 'movie', 'movie_hot_sidebar', 'hot_trailer', 'episode', 'movie_related'));
    }

    public function filter(){
        $order = $_GET['order'];
        $genre_filter = $_GET['genre_filter'];
        $country_filter = $_GET['country_filter'];
        $year_filter = $_GET['year'];

        if($order == " " && $genre_filter == " "&& $country_filter == " "){

        }else{
            $categories = Category::orderBy('id', 'desc')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
            $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
            $hot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(4)->get();
            $genres = Genre::orderBy('id', 'desc')->get();
            $countries = Country::orderBy('id', 'desc')->get();
            if($genre_filter){
                $movie = Movie::where('genre_id', $genre_filter)->paginate(40);
            }elseif($country_filter){
                $movie = Movie::where('country_id', $country_filter)->paginate(40);
            }elseif($year_filter){
                $movie = Movie::where('year', $year_filter)->paginate(40);
            }else{
                $movie = Movie::orderBy('title', 'ASC')->paginate(40);
            }
            return view('pages.include.filter', compact('categories', 'genres', 'countries', 'movie', 'movie_hot_sidebar', 'hot_trailer'));
        }
    }
}