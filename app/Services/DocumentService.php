<?php

namespace App\Services;


use App\Document;
use App\DTO\DocumentDTO;

/**
 * Сервис для работы с документами
 *
 * @package App\Services
 */
class DocumentService
{
    public function save(DocumentDTO $document)
    {
        return Document::create([
            'status' => $document->status,
            'payload' => $document->payload
        ]);
    }
}
