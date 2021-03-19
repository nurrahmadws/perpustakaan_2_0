<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Currency;
use App\Models\Penalty;
use App\Models\Category;

class PenaltyController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();
        $data['currencies'] = Currency::where('status', 'active')->orderBy('name', 'ASC')->get();
        return view('admin.master.penalty.index', $data);
    }

    public function store(Request $request)
    {
        $penalty = Penalty::create([
            'currency_id' => $request->currency_id,
            'amount'      => str_replace(',', '.',str_replace('.', '', $request->amount)),
            'format'      => $request->format,
            'status'      => $request->status,
            'created_by'  => auth()->user()->id,
            'updated_by'  => auth()->user()->id
        ]);
        $penalty->categories()->sync($request->category_id, false);
        return response()->json([
            'success' => 'Denda Berhasil Ditambahkan'
        ]);
    }

    public function show($id)
    {
        $data = Penalty::findOrFail($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        $data['penalty'] = Penalty::where('id', $id)->with(['categories', 'currency'])->first();
        $data['categories'] = Category::all();
        $data['currencies'] = Currency::where('status', 'active')->orderBy('name', 'ASC')->get();
        return view('admin.master.penalty.content_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $penalty = Penalty::findOrFail($id);
        $penalty->currency_id = $request->currency_id;
        $penalty->amount = str_replace(',', '.',str_replace('.', '', $request->amount));
        $penalty->format = $request->format;
        $penalty->status = $request->status;
        $penalty->updated_by = auth()->user()->id;
        $penalty->save();
        if (isset($request->category_id)) {
            $penalty->categories()->sync($request->category_id);
        } else {
            $penalty->categories()->sync(array());
        }

        return response()->json([
            'success' => 'Denda Berhasil Diperbaharui'
        ]);
    }

    public function delete($id)
    {
        $penalty = Penalty::findOrFail($id);
        $penalty->delete();
        return response()->json([
            'success' => "Denda Berhasil Dihapus"
        ]);
    }
}
