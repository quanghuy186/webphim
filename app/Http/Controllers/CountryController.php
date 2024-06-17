<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
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
        $list = Country::all();
        return view('admin.Country.form', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $Country = new Country;
        $Country->title = $data['title'];
        $Country->description = $data['description'];
        $Country->status = $data['status'];
        $Country->slug = $data['slug'];
        if( $Country->save()){
            toastr()->success('Thành công');
        }
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
        $countries = Country::find($id);
        $list = Country::all();
        return view('admin.Country.form', compact('list', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $Country = Country::find($id);
        $Country->title = $data['title'];
        $Country->description = $data['description'];
        $Country->status = $data['status'];
        $Country->slug = $data['slug'];
        if( $Country->update()){
            toastr()->success('Thành công');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Country::find($id)->delete()){
            toastr()->success('Thành công');
        }
        return redirect()->back();
    }
}