<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;

final class Error
{
    public function __construct(
        public readonly string $message,
        public readonly string $type,
        public readonly string $code,
        public readonly array  $params = []
    )
    {
    }
}