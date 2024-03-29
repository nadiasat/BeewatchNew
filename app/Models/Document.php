<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'file_path',
    ];

    public function documents()
    {
        // return all documents
        return $this->hasMany(Document::class, 'document_id');
    }




}