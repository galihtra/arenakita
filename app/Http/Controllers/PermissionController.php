<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('permissions.list', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3',
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success', 'Permission added successfully');

        } else {
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
         return view('permissions.edit',[
            'permission' => $permission,
         ]);
    }

    public function update($id, Request $request)
    {
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3|unique:permissions,name,'.$id.',id',
        ]);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permission.index')->with('success', 'Permission updated successfully');

        } else {
            return redirect()->route('permission.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::find($id);

        if ($permission == null) {
            session()->flash('error', 'Permission not found');
            return response()->json([
                'status' => false,
            ]);
        }

        $permission->delete();

         session()->flash('success', 'Permission deleted successfully');
            return response()->json([
                'status' => true,
            ]);
    }
}
