<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Inertia\Inertia;



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
            $path = $request->file('document')->store('public/documents');
            $document->file_path = $path;
        }

        //dd($document);

        $document->save();

        return redirect()->route('Documents');
        

    }



    

}
