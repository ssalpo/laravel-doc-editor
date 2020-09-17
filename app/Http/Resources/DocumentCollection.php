<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DocumentCollection extends ResourceCollection
{
    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            "page" => $resource->currentPage(),
            "perPage" => $resource->perPage(),
            "total" => $resource->total()
        ];

        parent::__construct($resource->getCollection());
    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($document) {
                return [
                    'id' => $document->id,
                    'status' => $document->status,
                    'payload' => $document->payload,
                    'created_at' => $document->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $document->updated_at->format('Y-m-d H:i:s'),
                ];
            }),
            'pagination' => $this->pagination
        ];
    }
}
