<?php
declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use TeeV\GptClient\Api\Gpt;
use TeeV\GptClient\HttpClient\ConnectionException;

$key = 'sk-ENTER-YOUR-KEY-HERE';

try {
    $client = new Gpt($key);
    $result = $client->getModels();
    $data = json_decode($result->body, true);

    if ($result->statusCode === 200) {
        echo 'Models: ', PHP_EOL;

        foreach ($data['data'] as $model) {
            echo ' - ', $model['id'], PHP_EOL;
        }
    } else {
        echo 'Error: ', $data['error']['message'], PHP_EOL;
    }

} catch (ConnectionException $e) {
    echo 'Error: ', $e->getMessage(), PHP_EOL;
}