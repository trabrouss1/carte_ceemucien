<?php

namespace App\Trait;

Trait IdentifierEncoderTrait
{

    public function encodeId(int $id): string
    {
        return base64_encode($id);
    }

    public function decodeId(string $id): int
    {
        return base64_decode($id);
    }

}