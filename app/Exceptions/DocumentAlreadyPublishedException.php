<?php

namespace App\Exceptions;

class DocumentAlreadyPublishedException extends \Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
