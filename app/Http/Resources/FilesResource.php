<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FilesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'document_title' => $this->resource->document_title,
            'paths' => route('Donwload.Files.Download', ['id' => $this->resource->id]),
            'created_at' => $this->resource->created_at
        ];
    }
}
