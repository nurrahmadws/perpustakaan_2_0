<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\CollectionType;

class CategoryController extends Controller
{
    public function index()
    {
        $data['collection_types'] = CollectionType::all();
        return view('admin.master.category.index', $data);
    }

    public function store(Request $request)
    {
        Category::create([
            'collection_type_id' => $request->collection_type_id,
            'name'               => $request->name,
            'code'               => $request->code,
            'created_by'         => auth()->user()->id,
            'updated_by'         => auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Kategori Buku Berhasil Dibuat'
        ]);
    }

    public function show($id)
    {
        $data = Category::findOrFail($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        $data['category'] = Category::findOrFail($id);
        $data['collection_types'] = CollectionType::all();
        return view('admin.master.category.isi_content_edit', $data);
    }

    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'collection_type_id' => $request->collection_type_id,
            'name'               => $request->name,
            'code'               => $request->code,
            'updated_by'         => auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Kategori Buku Berhasil diperbaharui'
        ]);
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return response()->json(['success' => 'Kategori Buku Berhasil dihapus']);
    }
}
