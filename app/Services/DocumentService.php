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
    /**
     * Создает новый документ
     *
     * @param DocumentDTO $documentDTO
     * @return Document
     */
    public function save(DocumentDTO $documentDTO)
    {
        return Document::create([
            'status' => $documentDTO->status ?? Document::DRAFT,
            'payload' => $documentDTO->payload
        ]);
    }

    /**
     * Публикует документ
     *
     * @param DocumentDTO $documentDTO
     */
    public function publish(DocumentDTO $documentDTO)
    {
        $document = Document::findOrFail($documentDTO->id);

        if ($document->status !== Document::PUBLISHED) {
            $document->update(['status' => Document::PUBLISHED]);
        }
    }
}
