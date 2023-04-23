<?php
declare(strict_types=1);

namespace TeeV\GptClient\HttpClient;

use CurlHandle;
use function curl_close;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function json_encode;
use const CURLINFO_HTTP_CODE;
use const CURLOPT_CONNECTTIMEOUT;
use const CURLOPT_CUSTOMREQUEST;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_TIMEOUT;
use const CURLOPT_URL;

final class Request implements RequestInterface
{
  private CurlHandle $curl;

  public function __construct()
  {
    $this->curl = curl_init();
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($this->curl, CURLOPT_TIMEOUT, 15);
  }

  public function __destruct()
  {
    curl_close($this->curl);
  }

  /**
   * @param string $url
   * @param array $params
   * @param array $headers
   * @return Response
   * @throws ConnectionException
   */
  public function post(string $url, array $params = [], array $headers = []): Response
  {
    return $this->sendRequest($url, 'POST', $params, $headers);
  }

  /**
   * @param string $url
   * @param array $params
   * @param array $headers
   * @return Response
   * @throws ConnectionException
   */
  public function get(string $url, array $params = [], array $headers = []): Response
  {
    return $this->sendRequest($url, 'GET', $params, $headers);
  }

  /**
   * @throws ConnectionException
   */
  private function sendRequest(string $url, string $method = 'GET', array $params = [], array $headers = []): Response
  {
    curl_setopt($this->curl, CURLOPT_URL, $url);
    curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);

    if ($method == 'POST' || $method == 'PUT') {
      curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($params));
    }

    if (!empty($headers)) {
      curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($this->curl);

    if ($response === false) {
      throw new ConnectionException(curl_error($this->curl));
    }

    if ($response === true) {
      $response = '';
    }

    /** @var int $httpCode */
    $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

    return new Response($httpCode, $response);
  }
}