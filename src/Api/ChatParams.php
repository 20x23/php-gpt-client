<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;
class ChatParams
{
  public function __construct(
    private readonly string $model,
    private readonly array  $messages,
  )
  {
  }

  public function getParams(): array
  {
    return [
      'model' => $this->model,
      'messages' => $this->messages
    ];
  }
}