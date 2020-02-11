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
        $unity=DB::table('unities as un')
        ->select('un.id','un.name','un.address')
        ->where('cu.state','=',1)
        ->get();
        return view('unity.index',compact('unity'));
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
        $unities =  new Unity;
        $unities->name = $request->name;
        $unities->address=$request->address;
        $course->save;
        return redirect()->route('unity.index')->with('succes','La unidad fue agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('unity.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($unities)
    {
        return view('unity.edit', compact('unities'))
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
        $unity = Unity::find($id);
        $unity->name = $request->name;
        $unity->address = $request->address;
        $unity->save();
        return redirect()->route('unity.index')->with('succes','Unidad fue actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course =Course:.find($id)
    }
}
