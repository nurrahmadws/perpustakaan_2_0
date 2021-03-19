<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data['permissions'] = Permission::orderBy('name', 'ASC')->get();
        return view('admin.role_management.role.index', $data);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => Str::slug($request->name, '_')]);
        $role->syncPermissions($request->permission);
        return response()->json([
            'success' => 'Role Berhasil dibuat'
        ]);
    }

    public function show($id)
    {
        $data = Role::where('id', $id)->with(['permissions:id'])->first();
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->select('id')
    	->get();
        return response()->json([
            'role' => $data,
            'permissions' => $rolePermissions->pluck('id')
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = Str::slug($request->name, '_');
        $role->save();
        $role->syncPermissions($request->permission);

        return response()->json([
            'success' => 'Role Berhasil diperbaharui'
        ]);
    }

    public function delete($id)
    {
        $role = Role::where('id', $id)->delete();
        return response()->json([
            'success' => 'Role Berhasil dihapus'
        ]);
    }
}
