<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unity;

class UnityController extends Controller
{

    function __construct(){
        $this->middleware('permission:unity-list');
        $this->middleware('permission:unity-create',['only'=>['create','store']]);
        $this->middleware('permission:unity-edit',['only'=>['edit','update']]);
        $this->middleware('permission:unityt-delete',['only'=>['destroy']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unities = Unity::where('state',1)->get();
        return view('unity.index',compact('unities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unity =  new Unity;
        $unity->name = $request->name;
        $unity->save();
        return redirect()->route('unities.index')->with('success','La Unidad Minera "' . $unity->name .  '" fue registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unity $unity)
    {
        return view('unity.show', compact('unity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Unity $unity
     * @return \Illuminate\Http\Response
     */
    public function edit(Unity $unity)
    {
        return view('unity.edit', compact('unity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unity = Unity::findOrFail($id);
        $unity->name = $request->name;
        $unity->save();

        return redirect()->route('unities.index')->with('success','La Unidad Minera "' . $unity->name . ' " fue actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unity = Unity::findOrFail($id);
    }
}
