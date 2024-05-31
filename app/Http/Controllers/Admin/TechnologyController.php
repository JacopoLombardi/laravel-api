<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::All();

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Technology::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology già esistente');
        }else{
            $new_technology = new Technology();
            $new_technology->name = $request->name;
            $new_technology->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Technology aggiunta correttamente');
        }
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
    public function update(Request $request, Technology $technology)
    {
        $validate_data = $request->validate([
            'name' => 'required|min:2|max:50'
        ],
        [
            'name.required' => 'Il name è obbligatorio',
            'name.min' => 'Il name deve contenere almeno :min caratteri',
            'name.max' => 'Il name deve contenere massimo :max caratteri'
        ]);



        $exist = Technology::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology non modificata perchè già esistente');
        }else{
            $technology->update($validate_data);
            return redirect()->route('admin.technologies.index')->with('success', 'Technology modificata correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technology è stata eliminata correttamente');
    }
}
