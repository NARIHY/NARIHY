<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download_document(string $id)
    {
        $document = Files::findOrFail($id);

        if(Storage::exists($document->paths)) {
            return Storage::download($document->paths, $document->document_title);
        }

        abort(Response::HTTP_NOT_FOUND, 'Files not found');
    }
}
