<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // function untuk menampilkan halaman role 
    public function index()
    {
        $roles = Role::orderBy('name','ASC')->paginate(10);
        return view('roles.list', [
            'roles' => $roles
        ]);
    }

    // function untuk menampilkan halaman create data
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', [
            'permissions' => $permissions,
        ]);
    }

    // function untuk insert data ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:roles|min:3',
        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('role.index')->with('success', 'Roles added successfully');

        } else {
            return redirect()->route('role.create')->withInput()->withErrors($validator);
        }
    }


}
