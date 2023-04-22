<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;

use TeeV\GptClient\HttpClient\ConnectionException;
use TeeV\GptClient\HttpClient\Request;
use TeeV\GptClient\HttpClient\Response;
use function sprintf;

class Gpt
{
  public function __construct(private readonly string $token)
  {
  }

  /**
   * @return Response
   * @throws ConnectionException
   */
  public function getModels(): Response
  {
    return (new Request())->get(
      'https://api.openai.com/v1/models',
      [],
      [
        $this->getAuthHeader()
      ]
    );
  }

  /**
   * @param ChatParams $params
   * @return Response|null
   * @throws ConnectionException
   */
  public function chat(ChatParams $params): ?Response
  {
    return (new Request())->post(
      'https://api.openai.com/v1/chat/completions',
      $params->getParams(),
      [
        $this->getAuthHeader(),
        $this->getContentTypeJsonHeader(),
      ]
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