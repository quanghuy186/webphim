<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

use function Laravel\Prompts\alert;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'desc')->get();
        return view('admin.episode.index', compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id', 'DESC')->get();
        return view('admin.episode.form', compact('list_movie'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $episode = new Episode();
        $check_episode = Episode::where('movie_id', $data['movie_id'])->where('episode', $data['episode'])->count();
        if($check_episode > 0){
            alert('Thêm không thành công do đã tồn tại tập phim này');
            return redirect()->back();
        }else{
            $episode->movie_id = $data['movie_id'];
            $episode->episode = $data['episode'];
            $episode->linkphim = $data['linkphim'];
            $episode->save();
        }
        
        return redirect()->back();
    }

    public function add_episode($id){
        $movie = Movie::find($id);
        $list_episode = Episode::where('movie_id', $id)->with('movie')->orderBy('movie_id', 'desc')->get();
        return view('admin.episode.add_episode', compact('list_episode', 'movie'));
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
        $list_movie = Movie::orderBy('id', 'DESC')->get();
        $episode = Episode::find($id);
        return view('admin.episode.form', compact('list_movie', 'episode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->movie_id = $data['movie_id'];
        $episode->episode = $data['episode'];
        $episode->linkphim = $data['linkphim'];
        $episode->save();
        return redirect()->route('episode.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id);
        $episode->delete();
        return redirect()->route('episode.index');
    }

    public function select_movie(){
        $select_movie = Movie::find($_GET['id']);
        if($select_movie->sotap > 1){
            $output = "<option>Chọn tập phim cho phim bộ</option>";
            for($i = 1; $i <= $select_movie->sotap; $i++){
                $output .= '<option value="'.$i.'">'.$i.'</option>';
            }
        }else{
            $output = "<option>Chọn tập cho phim lẻ</option>";
            $output .= '<option value="HD">HD</option>
            <option value="FullHD">FullHD</option>
            <option value="Cam">Cam</option>
            <option value="HDCam">HDCam</option>';
        }
        
        echo $output;
    }
}