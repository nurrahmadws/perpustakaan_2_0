<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return view('admin.master.currency.index');
    }

    public function store(Request $request)
    {
        Currency::create([
            'name'      => $request->name,
            'symbol'      => $request->symbol,
            'status'      => $request->status,
            'created_by'=> auth()->user()->id,
            'updated_by'=> auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Mata Uang Berhasil Dibuat'
        ]);
    }

    public function show($id)
    {
        $data = Currency::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        Currency::where('id', $id)->update([
            'name'      => $request->name,
            'symbol'      => $request->symbol,
            'status'      => $request->status,
            'updated_by'=> auth()->user()->id
        ]);
        return response()->json([
            'success' => 'Mata Uang Berhasil diperbaharui'
        ]);
    }

    public function delete($id)
    {
        Currency::where('id', $id)->delete();
        return response()->json(['success' => 'Mata Uang Berhasil dihapus']);
    }
}
