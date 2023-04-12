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
        //$documents = Document::all();

       return Inertia::render('Documents', [
            'documents' => "test"
        ]);
    }

    public function store(Request $request)
    {
        //print $request
        
    }



    

}
