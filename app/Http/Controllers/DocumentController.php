<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Inertia\Inertia;
use Psy\Readline\Hoa\Console;

class DocumentController extends Controller
{
   public function index()
    {
        $documents = Document::all();

        //dd($documents);

       return Inertia::render('Documents', [
            'documents' => $documents,
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());


        $document_path = '';

        

        
        

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'documentType' => 'required',
            'document' => 'required',
        ]);


        $document = Document::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->documentType,
            'file_path' => "VIDE",
        ]);

        if ($request->hasFile('document')) {
            $document_path = $request->file('document')->store('documents');
            $document->file_path = $document_path;
        }

        

        //dd($document);

        $document->save();

        return redirect()->route('documents');
        

    }

    public function show(String $document_path)
    {
        //dd($document_path);
        $document_path = storage_path('app/documents/' . $document_path);
        return response()->file($document_path);
    }



    

}
