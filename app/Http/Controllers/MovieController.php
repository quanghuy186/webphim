<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Country;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category', 'movie_genre', 'country','genre')->orderBy('updated_at', 'DESC')->get();
        $path = public_path() . "/json/";
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
            // Ghi dữ liệu vào tệp JSON
         File::put($path . "movies.json", json_encode($list));

        return view('admin.movie.index', compact('list'));    
    }    

    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_season(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }

    public function topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }

    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview', $data['value'])->orderBy('updated_at', 'DESC')->take(20)->get();
        $output = '';
        foreach ($movie as $key => $mov){
            if($mov->resolution == 0){
                $text = 'HD';
            }else if($mov->resolution == 1){
                $text = 'SD';
            }else if($mov->resolution == 2){
                $text = 'SDCam';
            }else if($mov->resolution == 2){
                $text = 'Full HD';
            }else{
                $text = 'Trailer';
            }

            $output.= '
                <div class="item post-37176">
                    <a href="'.  route("movie", $mov->slug) .'" title="'. $mov->title .'">
                        <div class="item-link">
                            <img src="uploads/movie/'.$mov->image.'" class="lazy post-thumb" alt="'. $mov->title .'" title="'. $mov->title .'" />
                            <span class="is_trailer">'.$text.'</span>
                        </div>
                        <p class="title">'. $mov->title .'</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                        <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>
            ';
        }
        echo $output;
    }
    
    public function filter_default(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview', 0)->orderBy('updated_at', 'DESC')->take(20)->get();
        $output = '';
        foreach ($movie as $key => $mov){
            if($mov->resolution == 0){
                $text = 'HD';
            }else if($mov->resolution == 1){
                $text = 'SD';
            }else if($mov->resolution == 2){
                $text = 'SDCam';
            }else if($mov->resolution == 2){
                $text = 'Full HD';
            }else{
                $text = 'Trailer';
            }

            $output.= '
                <div class="item post-37176">
                    <a href="'.  route("movie", $mov->slug) .'" title="'. $mov->title .'">
                        <div class="item-link">
                            <img src="uploads/movie/'.$mov->image.'" class="lazy post-thumb" alt="'. $mov->title .'" title="'. $mov->title .'" />
                            <span class="is_trailer">'.$text.'</span>
                        </div>
                        <p class="title">'. $mov->title .'</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                        <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>
            ';
        }
        echo $output;
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
        $movie->trailer = $data['trailer'];
        $movie->name_eng = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->tags = $data['tags'];
        $movie->time = $data['time'];
        $movie->status = $data['status'];
        $movie->resolution = $data['resolution'];
        $movie->slug = $data['slug'];
        $movie->vietsub = $data['vietsub'];
        $movie->category_id = $data['category_id'];
        $movie->movie_hot = $data['movie_hot'];
        // $movie->genre_id = $data['genre_id'];
        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
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

        //atrach có chức năng đính kèm dữ liệu
        $movie->movie_genre()->attach($data['genre']);
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
        $movie->trailer = $data['trailer'];
        $movie->name_eng = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->tags = $data['tags'];
        $movie->time = $data['time'];
        $movie->status = $data['status'];
        $movie->resolution = $data['resolution'];
        $movie->slug = $data['slug'];
        $movie->vietsub = $data['vietsub'];
        $movie->category_id = $data['category_id'];
        $movie->movie_hot = $data['movie_hot'];
        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
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
        $movie->movie_genre()->sync($data['genre']);
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