<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\KindOfFlower;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flowers = Flower::all('id' , 'totePrice' , 'available_guantity' , 'Price' , 'kind_id');
        $kindFlower = KindOfFlower::all();

        return view('flowers.index' , compact('flowers' , 'kindFlower'));

        // return $flowers->kind->name;

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
        Flower::create([
            'kind_id' => $request->kind,
            'totePrice' => $request->toal_price,
            'available_guantity' =>$request->available_guantity ,
            'Price' => $request->price
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function show(Flower $flower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flower = Flower::find($id);
        $kindId = KindOfFlower::where('id' , $flower->kind_id)->get();

        return view('flowers.edit' , compact('flower' , 'kindId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       DB::table('flowers')->where('id' , $id)->update([
        'kind_id' => $request->kind,
        'totePrice' => $request->toal_price,
        'available_guantity' =>$request->available_guantity ,
        'Price' => $request->price
       ]);

       return response()->view('flowers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //    return $id;
    }

    public function deleted($id) {

        Flower::destroy($id);

        return redirect()->back();

    }
}
