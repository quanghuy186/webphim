<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Country;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'desc')->get();
        return view('admin.movie.index', compact('list'));
    }

    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
   }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'desc')->get();
        $categories = Category::all();
        $genres = Genre::all();
        $countries = Country::all();
        return view('admin.movie.form', compact('list', 'categories', 'genres', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movie = new Movie;
        $data = $request->all();
        $movie->title = $data['title'];
        $movie->name_eng = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->resolution = $data['resolution'];
        $movie->slug = $data['slug'];
        $movie->vietsub = $data['vietsub'];
        $movie->category_id = $data['category_id'];
        $movie->movie_hot = $data['movie_hot'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $get_image = $request->file('image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.jpg
            $name_image =  current(explode('_', $get_name_image));//[0]c => hinhanh1 . [1] => jpg
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh12334.jpg
            $get_image->move('uploads/movie/', $new_image);
            $movie->image = $new_image;
        }

        $movie->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'desc')->get();
        $categories = Category::all();
        $genres = Genre::all();
        $countries = Country::all();
        $movies = Movie::find($id);
        return view('admin.movie.form', compact('list', 'categories', 'genres', 'countries', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->title = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->status = $data['resolution'];
        $movie->slug = $data['slug'];
        $movie->vietsub = $data['vietsub'];
        $movie->category_id = $data['category_id'];
        $movie->movie_hot = $data['movie_hot'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];

        $get_image = $request->file('image');

        if($get_image){
            if(file_exists('uploads/movie/'. $movie->image)){
                unlink('uploads/movie/'. $movie->image);
            }else{
                $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.jpg
                $name_image =  current(explode('_', $get_name_image));//[0]c => hinhanh1 . [1] => jpg
                $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh12334.jpg
                $get_image->move('uploads/movie/', $new_image);
                $movie->image = $new_image;
            }
        }

        $movie->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        if(file_exists('uploads/movie/'. $movie->image)){
            unlink('uploads/movie/'. $movie->image);
        }
        $movie->delete();
        return redirect()->back();
    }
}