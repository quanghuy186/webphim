<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Category::orderBy('position', 'ASC')->get();
        return view('admin.category.form', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $category = new Category;
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = $data['slug'];
        $category->save();
        return redirect()->route('category.create')->with('success', "Thêm mới thành công");
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
        $categories = Category::find($id);
        $list = Category::orderBy('position',  'ASC')->get();
        return view('admin.category.form', compact('list', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = $data['slug'];
        $category->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->route('category.create')->with('success', "Xóa thành công");
    }

    public function resorting(Request $request){
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}