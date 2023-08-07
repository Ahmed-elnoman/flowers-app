<?php

namespace App\Http\Controllers;

use App\Models\KindOfFlower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KindOfFlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kind_items = KindOfFlower::all();
       return view('flowers.kind.index' , compact('kind_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $originalName = $request->file('img')->getClientOriginalName();

        $path = $request->file('img')->storeAs('public/Flower' , $originalName , 'public');

        KindOfFlower::create([
            'name'   => $request->name,
            'image'  => $path,
            'color'  => $request->color,
            'country' => $request->country
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KindOfFlower  $kindOfFlower
     * @return \Illuminate\Http\Response
     */
    public function show(KindOfFlower $kindOfFlower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KindOfFlower  $kindOfFlower
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kind = KindOfFlower::find($id);
        return view('flowers.kind.edit' , compact('kind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KindOfFlower  $kindOfFlower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $originalName2 = $request->file('img')->getClientOriginalName();
        $path          = Storage::disk('public')->putFileAs('public/Flower', $request->file('img') , $originalName2 );

        DB::table('kind_of_flowers')->where('id' , $id)->update([
            'name'   => $request->name,
            'image'  => $path,
            'color'  => $request->color,
            'country' => $request->country,
        ]);

        return view('flowers.kind.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KindOfFlower  $kindOfFlower
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }

    public function destroykind($id) {
        KindOfFlower::destroy($id);

        return redirect()->back();
    }
}
