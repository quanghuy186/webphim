<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.episode');
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
        $episode->movie_id = $data['select_movie'];
        $episode->episode = $data['episode'];
        $episode->linkphim = $data['linkphim'];
        $episode->save();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function select_movie(){
        $select_movie = Movie::find($_GET['id']);
        $output = "<option>Chọn tập phim</option>";
        for($i = 1; $i <= $select_movie->sotap; $i++){
            $output .= '<option value="'.$i.'">'.$i.'</option>';
        }
        echo $output;
    }
}