<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::All();

        return view('admin.types.index', compact('types'));
    }

    public function typeProjects(){
        $types = Type::all();

        return view('admin.types.type-projects', compact('types'));
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
        $exist = Type::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.types.index')->with('error', 'Type già esistente');
        }else{
            $new_types = new Type();
            $new_types->name = $request->name;
            $new_types->save();

            return redirect()->route('admin.types.index')->with('success', 'Type aggiunta correttamente');
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
    public function update(Request $request, Type $type)
    {
        $validate_data = $request->validate([
            'name' => 'required|min:2|max:50'
        ],
        [
            'name.required' => 'Il name è obbligatorio',
            'name.min' => 'Il name deve contenere almeno :min caratteri',
            'name.max' => 'Il name deve contenere massimo :max caratteri'
        ]);



        $exist = Type::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.types.index')->with('error', 'Type non modificato perchè già esistente');
        }else{
            $type->update($validate_data);
            return redirect()->route('admin.types.index')->with('success', 'Type modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'type è stata eliminata correttamente');
    }
}
