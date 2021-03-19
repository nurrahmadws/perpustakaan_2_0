<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CollectionType;

class CollectionTypeController extends Controller
{
    public function index()
    {
        return view('admin.master.collection_type.index');
    }

    public function store(Request $request)
    {
        CollectionType::create([
            'code'      => $request->code,
            'name'      => $request->name,
            'created_by'=> auth()->user()->id,
            'updated_by'=> auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Jenis Koleksi Berhasil Dibuat'
        ]);
    }

    public function show($id)
    {
        $data = CollectionType::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        CollectionType::where('id', $id)->update([
            'code'      => $request->code,
            'name'      => $request->name,
            'updated_by'=> auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Jenis Koleksi Berhasil diperbaharui'
        ]);
    }

    public function delete($id)
    {
        CollectionType::where('id', $id)->delete();
        return response()->json(['success' => 'Jenis Koleksi Berhasil dihapus']);
    }
}
