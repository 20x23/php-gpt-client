<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;

use TeeV\GptClient\HttpClient\ConnectionException;
use TeeV\GptClient\HttpClient\Request;
use TeeV\GptClient\HttpClient\RequestInterface;
use TeeV\GptClient\HttpClient\Response;
use function sprintf;

class Gpt
{
    public function __construct(
        private readonly string           $token,
        private readonly RequestInterface $request = new Request()
    )
    {
    }

    /**
     * @return Response
     * @throws ConnectionException
     */
    public function getModels(): Response
    {
        return $this->request->get(
            'https://api.openai.com/v1/models',
            [],
            [
                $this->getAuthHeader()
            ]
        );
    }

    /**
     * @param ChatParams $params
     * @return Result
     * @throws ConnectionException
     * @throws DecoderException
     */
    public function chat(ChatParams $params): Result
    {
        return Result::fromJson(
            $this->request->post(
                'https://api.openai.com/v1/chat/completions',
                $params->getParams(),
                [
                    $this->getAuthHeader(),
                    $this->getContentTypeJsonHeader(),
                ]
            )->body
        );
    }

    private function getAuthHeader(): string
    {
        return sprintf("Authorization: Bearer %s", $this->token);
    }

    private function getContentTypeJsonHeader(): string
    {
        return "Content-Type: application/json";
    }
}