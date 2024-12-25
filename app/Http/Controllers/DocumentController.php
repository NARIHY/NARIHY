<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Download document in application
     * @param string $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download_document(string $id)
    {
        $document = Files::findOrFail($id);

        if(Storage::disk('public')->exists($document->paths)) {
            return Storage::disk('public')->download($document->paths, $document->document_title);
        }

        abort(Response::HTTP_NOT_FOUND, 'Files not found');
    }
}
