<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Trait\uploadFile;
use App\Http\Requests\StoreDocument;
use App\Http\Requests\UpdateDocument;
use Illuminate\Support\Facades\Cache;

class DocumentController extends Controller
{

    use uploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents=Cache::remember('document',60,function(){
            return Document::all();
        });

        return response()->json([
            'status' =>'success',
            'documents' => $documents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocument $request)
    {
        $file_path = $this->uploadFile($request, 'Document', 'myfile');
        


        $documents=Document::create([
            'name' => $request->name,
            'document' => $file_path,
            'doctype_id' => $request->doctype_id,


        ]);

        return response()->json([
           'status' =>'success',
            'documents' => $documents,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return response()->json([
            'status' =>'success',
             'documents' => $document,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocument $request, Document $document)
    {
        $document->update([
            'name' => $request->name,
            'path' => $request->path,
            'doctype_id' => $request->doctype_id,
        ]);

        return response()->json([
           'status' =>'success',
            'type' => $document,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return response()->json([
            'status' =>'success',
             'type' => $document,
         ]);
    }
}
