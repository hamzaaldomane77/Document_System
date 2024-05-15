<?php

namespace App\Http\Controllers;

use App\Models\Doctype;
use Illuminate\Http\Request;
use App\Http\Requests\StoreType;
use Illuminate\Support\Facades\Cache;

class DoctypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctype=Cache::remember('document_type',60,function(){
            return Doctype::with('documents')->get();
        });

        return response()->json([
            'status' =>'success',
            'doctype' => $doctype,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreType $request)
    {
        $type=Doctype::create([
            'name' => $request->name,
        ]);

        return response()->json([
           'status' =>'success',
            'type' => $type,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctype $doctype)
    {

        return response()->json([
            'status' =>'success',
             'type' => $doctype,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctype $doctype)
    {
        $doctype->update([
            'name' => $request->name,
        ]);

        return response()->json([
           'status' =>'success',
            'type' => $doctype,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctype $doctype)
    {
        $doctype->delete();

        return response()->json([
           'status' =>'success',
            'type' => $doctype,
        ]);
    }
}
