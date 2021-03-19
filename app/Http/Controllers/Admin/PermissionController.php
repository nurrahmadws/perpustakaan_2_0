<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.role_management.permission.index');
    }

    public function store(Request $request)
    {
        Permission::create(['name' => Str::slug($request->name, '_')]);
        return response()->json([
            'success' => 'Permission Berhasil Dibuat'
        ]);
    }

    public function show($id)
    {
        $data = Permission::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        Permission::where('id', $id)->update(['name' => Str::slug($request->name, '_')]);
        return response()->json([
            'success' => 'Permission Berhasil diperbaharui'
        ]);
    }

    public function destroy($id)
    {
        Permission::where('id', $id)->delete();
        return response()->json(['success' => 'Permission Berhasil dihapus']);
    }
}
