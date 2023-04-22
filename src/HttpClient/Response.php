<?php
declare(strict_types=1);

namespace TeeV\GptClient\HttpClient;
class Response
{
  public function __construct(
    public readonly int    $statusCode,
    public readonly string $body)
  {
  }
}