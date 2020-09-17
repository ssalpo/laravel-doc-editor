<?php

namespace App\Http\Controllers;

use App\Document;
use App\DTO\DocumentDTO;
use App\Http\Resources\DocumentCollection;
use App\Http\Resources\DocumentResource;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentController extends Controller
{
    /**
     * @var DocumentService
     */
    private $documentService;

    public function __construct(DocumentService $document)
    {
        $this->documentService = $document;
    }

    /**
     * Возвращает список всех документов
     *
     * @return JsonResource
     */
    public function index()
    {
        return new DocumentCollection(Document::paginate(20));
    }

    /**
     * Сохраняет документ
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $document = $this->documentService->save(new DocumentDTO($request->all()));

        return new DocumentResource($document);
    }

    /**
     * Возвращает документ по id
     *
     * @param Document $document
     * @return JsonResource
     */
    public function show(Document $document)
    {
        return new DocumentResource($document);
    }

    /**
     * Обновляет документ
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResource
     */
    public function update(Request $request, $id)
    {
        $document = $this->documentService->save(
            new DocumentDTO(
                array_merge(['id' => $id], $request->get('document'))
            )
        );

        return new DocumentResource($document);
    }

    /**
     * Публикует документ
     *
     * @param int $id
     * @return JsonResource
     */
    public function publish($id)
    {
        $document = $this->documentService->publish(new DocumentDTO(['id' => $id]));

        return new DocumentResource($document);
    }
}
