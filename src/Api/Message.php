<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;
class Message
{
  public function __construct(
    private readonly Role   $role,
    private readonly string $content,
    private readonly string $name
  )
  {
  }

  public function getMessage(): array
  {
    return [
      'role' => $this->role->value,
      'content' => $this->content,
      'name' => $this->name
    ];
  }
}