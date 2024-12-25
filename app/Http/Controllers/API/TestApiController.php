<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilesResource;
use App\Models\Files;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function test() {
        $files = FilesResource::collection(Files::get());
        return $files;
    }
}
