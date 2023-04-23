<?php
declare(strict_types=1);

namespace TeeV\GptClient\HttpClient;
interface RequestInterface
{
  /**
   * @param string $url
   * @param array $params
   * @param array $headers
   * @return Response
   * @throws ConnectionException
   */
  public function post(string $url, array $params = [], array $headers = []): Response;

  /**
   * @param string $url
   * @param array $params
   * @param array $headers
   * @return Response
   * @throws ConnectionException
   */
  public function get(string $url, array $params = [], array $headers = []): Response;
}