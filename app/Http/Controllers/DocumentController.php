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

        
        //dd($request->all());
        
        

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

        //dd($document->name);

        if ($request->hasFile('document')) {
    
            dd($request->file('document'));
            // Store as permet de renommer le fichier et d'empecher le hash automatique du nom de fichier
            $document_path = $request->file('document')->storeAs('documents', $document->name . '.pdf');
            $document->file_path = $document_path;
        }

        $document->save();

        return redirect()->route('documents');
        

    }

    public function show(String $document_path)
    {
        //dd($document_path);
        // Find the complete path of the document
        $document_path = storage_path('app/documents/' . $document_path);
        return response()->file($document_path);
    }


    public function destroy(String $document_id)
    {
        // Find the document with the given id
        $document = Document::find($document_id);
        // Delete the document
        $document->delete();
        // Redirect to the documents page
        return redirect()->route('documents');
    }

}
