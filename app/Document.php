<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Document extends Model
{
    /**
     * Статусы документов
     */
    const DRAFT = 'draft';
    const PUBLISHED = 'published';

    protected $table = 'documents';

    /**
     * Тип для поля id, установил string
     * так как используем uuid
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Отключаем инкерементацию поля id
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'payload',
        'status'
    ];

    protected $casts = [
        'payload' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        // Тут при создании нового документа генерируем UUID;
        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    /**
     * Возвращает списк статусов документа
     *
     * @return string[]
     */
    public static function getStatuses()
    {
        return [
            self::DRAFT,
            self::PUBLISHED,
        ];
    }
}
