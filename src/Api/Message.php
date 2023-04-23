<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;
class Message
{
    public function __construct(
        public readonly Role    $role,
        public readonly string  $content,
        public readonly ?string $name = null)
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

    public static function fromArray(array $data): self
    {
        return new self(
            Role::tryFrom($data['role']),
            $data['content'],
            $data['name'] ?? null
        );
    }
}