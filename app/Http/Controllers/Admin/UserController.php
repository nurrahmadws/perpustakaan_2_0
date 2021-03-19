<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB, Validator;

class UserController extends Controller
{
    public function index()
    {
        $data['roles'] = Role::whereNotIn('name', ['Membership', 'Admin'])->orderBy('name', 'ASC')->get();
        return view('admin.role_management.user.index', $data);
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        $user->assignRole([$request->roles]);
        return response()->json([
            'success' => 'User Berhasil Dibuat'
        ]);
    }

    public function show($id)
    {
        $data = User::where('id', $id)->with(['roles:id,name'])->first();
        return response()->json([
            'user' => $data,
            'roles'=> $data->roles()->pluck('id')
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'email' => 'email',
            'roles' => 'required'
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user = User::findOrFail($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole([$request->roles]);

        return response()->json([
            'success' => 'User Berhasil Diedit'
        ]);
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return response()->json([
            'success' => 'User Berhasil Dihapus'
        ]);
    }
}
