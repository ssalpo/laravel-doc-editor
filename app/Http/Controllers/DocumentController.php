<?php

namespace App\Http\Controllers;

use App\Document;
use App\DTO\DocumentDTO;
use App\Http\Resources\DocumentResource;
use App\Services\DocumentService;
use Illuminate\Http\Request;

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
     * @return void
     */
    public function index()
    {
    }

    /**
     * Сохраняет документ
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $this->documentService->save(new DocumentDTO($request->all()));
    }

    /**
     * Возвращает документ по id
     *
     * @param Document $document
     * @return array
     */
    public function show(Document $document)
    {
        return ['document' => new DocumentResource($document)];
    }

    /**
     * Обновляет документ
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Публикует документ
     *
     * @param int $id
     */
    public function publish($id)
    {
        //
    }
}
