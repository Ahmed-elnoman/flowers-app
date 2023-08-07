<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
   function index() {

    $permissions = Permission::all();

    return view('admin.permissions.index' , compact('permissions'));

   }

   function store(Request $request) {

    $validate  =   $request->validate(['name' => 'required | string']);
    Permission::create($validate);

    // Alert::success('success', 'added Successfully');

    return back();

   }

   function edit(Permission $permission){

    $role_permissions = Role::with('permissions')->get();
        return view('admin.permissions.edit' , compact('permission' , 'role_permissions'));

   }

   function update(Request $request , Permission $permission){

        $validate = $request->validate(['name' => 'required | string']);
        $permission->update($validate);
        // Alert::success('success', 'updated Successfully');
        return redirect()->route('permission.index');

   }

   function destroy(Permission $permission) {

        Permission::destroy($permission->id);
        return back();
   }

   function assign(Request $request , Permission $permission) {

        if($permission->hasRole($request->name)){
            return back()->with('massage', 'Role is exits');
        }

        $permission->assignRole($request->name);
        return back();

   }

   function removeRole(Permission $permission , Role $role){

        $permission->removeRole($role);

        return back();

   }
}
