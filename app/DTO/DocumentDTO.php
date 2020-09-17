<?php

namespace App\DTO;

use App\Document;
use App\Exceptions\IncorrectDocumentDataException;
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
    public $status;

    /**
     * @var array
     */
    public $payload;

    public function __construct(array $data = [])
    {
        $this->status = Arr::get($data, 'status', 'draft');
        $this->payload = Arr::get($data, 'payload', []);

        $this->validate();
    }

    /**
     * Валидирует входные данные
     *
     * @throws IncorrectDocumentDataException
     */
    private function validate()
    {
        if (!in_array($this->status, Document::getStatuses())) {
            throw new IncorrectDocumentDataException('Некорректный статус документа');
        }

        if (!is_array($this->payload)) {
            throw new IncorrectDocumentDataException('Некорректн значение передано в payload');
        }
    }
}
