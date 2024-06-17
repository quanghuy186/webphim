<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Genre::all();
        return view('admin.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Genre::all();
        return view('admin.genre.form', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:genres|max:255',
            'description' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:genres',
        ],
        [
            'title.required' => 'Không được để trống',
            'title.unique' => 'Tên này đã tồn tại',
            'description.required' => 'Không được để trống',
            'status.required' => 'Không được để trống',
            'slug.required' => 'Không được để trống',
            ]
        );
        $genre = new Genre;
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];

        if($genre->save()){
            toastr()->success('Data has been saved successfully!');
        }
        return redirect()->route('genre.index');
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
        $genres = Genre::find($id);
        $list = Genre::all();
        return view('admin.genre.form', compact('list', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|unique:genres|max:255',
            'description' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:genres',
        ],
        [
            'title.required' => 'Không được để trống',
            'title.unique' => 'Tên này đã tồn tại',
            'description.required' => 'Không được để trống',
            'status.required' => 'Không được để trống',
            'slug.required' => 'Không được để trống',
            ]
        );
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->update();
        return redirect()->back()->with('success', "Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Genre::find($id)->delete()){
            toastr()->success('Deleted successfully');
        }
        return redirect()->route('genre.index');
    }
}