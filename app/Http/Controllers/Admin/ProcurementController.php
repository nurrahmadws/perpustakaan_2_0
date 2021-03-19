<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Procurement;

class ProcurementController extends Controller
{
    public function index()
    {
        return view('admin.master.procurement.index');
    }

    public function store(Request $request)
    {
        Procurement::create([
            'code'      => $request->code,
            'name'      => $request->name,
            'created_by'=> auth()->user()->id,
            'updated_by'=> auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Jenis Pengadaan Berhasil Dibuat'
        ]);
    }

    public function show($id)
    {
        $data = Procurement::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        Procurement::where('id', $id)->update([
            'code'      => $request->code,
            'name'      => $request->name,
            'updated_by'=> auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Jenis Pengadaan Berhasil diperbaharui'
        ]);
    }

    public function delete($id)
    {
        Procurement::where('id', $id)->delete();
        return response()->json(['success' => 'Jenis Pengadaan Berhasil dihapus']);
    }
}
