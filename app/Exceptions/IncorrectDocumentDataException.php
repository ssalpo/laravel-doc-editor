<?php

namespace App\Exceptions;

class IncorrectDocumentDataException extends \Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
