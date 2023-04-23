<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;
class ChatParams
{
    /**
     * @param string $model
     * @param list<Message> $messages
     */
    public function __construct(
        private readonly string $model,
        private readonly array  $messages)
    {
    }

    public function getParams(): array
    {
        return [
            'model' => $this->model,
            'messages' => array_map(
                fn(Message $message) => $message->asArray(),
                $this->messages
            )
        ];
    }
}