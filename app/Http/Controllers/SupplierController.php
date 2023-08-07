<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function  index(){

        $suppliers = User::get('name' , 'phone' , 'country' , 'address' , 'email');
        return view('admin.suppliers.index' , compact('suppliers'));
    }

    function store(Request $request){

        $request->validate([
            'supplire_name' => 'string | max:10',
            'phone' => 'integer | max:20',
            'email' => 'email',
            'country' => 'string',
            'address' => 'string'
        ]);

        // User::create([

        // ]);

        DB::table('users')->create([
            'name' => $request->supplire_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'address' => $request->address,
            'status'  => 'users'
        ]);

        return back();

        return back();

    }
}
