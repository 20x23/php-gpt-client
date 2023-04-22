<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;
class Message
{
  public function __construct(
    private readonly Role    $role,
    private readonly string  $content,
    private readonly ?string $name
  )
  {
  }

  public function getMessage(): array
  {
    $message = [
      'role' => $this->role->value,
      'content' => $this->content
    ];

    if (null !== $this->name) {
      $message['name'] = $this->name;
    }

    return $message;
  }
}