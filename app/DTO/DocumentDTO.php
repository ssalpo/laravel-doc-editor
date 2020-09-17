<?php

namespace App\DTO;

use App\Document;
use App\Exceptions\IncorrectDocumentDataException;
use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * Простой DTO для типизации входных параметров
 *
 * @package App\DTO
 */
class DocumentDTO
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    public $payload;

    /**
     * @var null|Carbon
     */
    public $created_at;

    /**
     * @var null|Carbon
     */
    public $updated_at;

    public function __construct(array $data = [])
    {
        $this->id = Arr::get($data, 'id');
        $this->status = Arr::get($data, 'status');
        $this->payload = Arr::get($data, 'payload', []);
        $this->created_at = Arr::get($data, 'created_at');
        $this->updated_at = Arr::get($data, 'created_at');

        $this->validate();
    }

    /**
     * Валидирует входные данные
     *
     * @throws IncorrectDocumentDataException
     */
    private function validate()
    {
        if ($this->id && $this->isCorrectUUID($this->id)) {
            throw new IncorrectDocumentDataException('Некорректный uuid передан');
        }

        if ($this->status && !in_array($this->status, Document::getStatuses())) {
            throw new IncorrectDocumentDataException('Некорректный статус документа');
        }

        if (!is_array($this->payload)) {
            throw new IncorrectDocumentDataException('Некорректн значение передано в payload');
        }
    }

    private function isCorrectUUID($uuid)
    {
        return !is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1);
    }
}
