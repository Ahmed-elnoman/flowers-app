<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
   function index(){
        $roles = Role::whereNotIn('name' ,['Admin'])->get();
        return view('admin.roles.index' , compact('roles'));
   }


   function store(Request $request) {

   $validate = $request->validate(['name' => 'string | max:10']);
   Role::create($validate);
    return back();

   }

   function edit( Role $role){
        $permissions = Permission::all();
        return view('admin.roles.edit' , compact('role' , 'permissions'));

   }


   function update(Request $request , Role $role){

    $validate = $request->validate(['name' => 'string | max:10']);
    $role->update($validate);
    return redirect()->route('roles.index');

   }

   function destroy(Role $role){

    Role::destroy($role->id);

    return back();

   }

   function givePermission(Request $request , Role $role){

        if($role->hasPermissionTo($request->name)){
            return back();
        }
        $role->givePermissionTo($request->name);
        return back();

   }

   function  revoke( Role $role ,Permission $permission ) {

        $role->revokePermissionTo($permission);

        return back();

   }
}
