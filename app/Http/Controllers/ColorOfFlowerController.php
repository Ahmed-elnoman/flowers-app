<?php

namespace App\Http\Controllers;

use App\Models\ColorOfFlower;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ColorOfFlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colorItems = ColorOfFlower::all();
        // return $colorItems;
       return view('flowers.colors.index', compact('colorItems'));
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

        $name = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('Flower/color' , $name , 'img');
        // return $name;
      ColorOfFlower::create([
        'name' => $request->name,
        'hyperlink_to_the_icon' => $path
      ]);
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ColorOfFlower  $colorOfFlower
     * @return \Illuminate\Http\Response
     */
    public function show(ColorOfFlower $colorOfFlower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ColorOfFlower  $colorOfFlower
     * @return \Illuminate\Http\Response
     */
    public function edit(ColorOfFlower $colorOfFlower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ColorOfFlower  $colorOfFlower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColorOfFlower $colorOfFlower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ColorOfFlower  $colorOfFlower
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColorOfFlower $colorOfFlower)
    {
        //
    }
}
