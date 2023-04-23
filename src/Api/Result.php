<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;

use JsonException;
use function json_decode;

final class Result
{
    /** @var Message[] */
    private array $messages = [];

    public function __construct(
        public readonly string $id,
        public readonly array  $choices,
        public readonly array  $usage,
        public readonly ?Error $error = null)
    {
        foreach ($choices as $choice) {
            $this->messages[] = Message::fromArray($choice['message']);
        }
    }

    /**
     * @param string $json
     * @return self
     * @throws DecoderException
     */
    public static function fromJson(string $json): self
    {
        try {
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

            if (isset($data['error'])) {
                return new self(
                    '',
                    [],
                    [],
                    new Error(
                        $data['error']['message'],
                        $data['error']['type'],
                        $data['error']['code'],
                        $data['error']['params'] ?? []
                    )
                );
            } else {
                return new self(
                    $data['id'],
                    $data['choices'],
                    $data['usage']
                );
            }
        } catch (JsonException $e) {
            throw new DecoderException(
                sprintf('Unable to decode JSON: "%s"', json_last_error_msg()),
                0,
                $e
            );
        }
    }

    public function getPrimaryAnswer(): string
    {
        return $this->messages[0]->content ?? '';
    }

    public function success(): bool
    {
        return $this->error === null;
    }
}