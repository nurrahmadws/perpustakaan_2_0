<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return view('admin.master.author.index');
    }

    public function store(Request $request)
    {
        $data = Author::create([
            'name'               => $request->name,
            'code'         => $request->code,
            'created_by'         => auth()->user()->id,
            'updated_by'         => auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Author Berhasil Dibuat',
            'author_id' => $data->id,
            'author_name' => $data->name,
            'author_code' => $data->code
        ]);
    }

    public function show($id)
    {
        $data = Author::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        Author::where('id', $id)->update([
            'name'               => $request->name,
            'code'         => $request->code,
            'updated_by'         => auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Author Berhasil diperbaharui'
        ]);
    }

    public function delete($id)
    {
        Author::where('id', $id)->delete();
        return response()->json(['success' => 'Author Berhasil dihapus']);
    }
}
