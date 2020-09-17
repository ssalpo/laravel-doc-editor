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
        // Если id есть, то берем из базы и возвращаем для сохранения данных, иначе создаем новый
        $document = $documentDTO->id
            ? Document::findOrFail($documentDTO->id)
            : new Document();

        $data = [
            'status' => $documentDTO->status ?? ($document && $document->status ? $document->status : Document::DRAFT),
            'payload' => $documentDTO->payload
        ];

        // Ставим дефолтный статус
//        if (!$documentDTO->id && !$documentDTO->status) {
//            $document['status'] = Document::DRAFT;
//        }

        $document->fill($data)->save();

        return $document;
    }

    /**
     * Публикует документ
     *
     * @param DocumentDTO $documentDTO
     * @return Document
     */
    public function publish(DocumentDTO $documentDTO)
    {
        $document = Document::findOrFail($documentDTO->id);

        if ($document->status !== Document::PUBLISHED) {
            $document->update(['status' => Document::PUBLISHED]);
        }

        return $document;
    }
}
