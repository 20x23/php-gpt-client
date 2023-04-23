<?php
declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use TeeV\GptClient\Api\ChatParams;
use TeeV\GptClient\Api\DecoderException;
use TeeV\GptClient\Api\Gpt;
use TeeV\GptClient\Api\Message;
use TeeV\GptClient\Api\Role;
use TeeV\GptClient\HttpClient\ConnectionException;

$key = 'sk-ENTER-YOUR-KEY-HERE';

try {
    $client = new Gpt($key);
    $result = $client->chat(
        new ChatParams(
            'gpt-3.5-turbo',
            [
                (new Message(
                    Role::SYSTEM,
                    'You are super happy because the sun is shining and tell everyone who asks you how you are doing')
                ),
                (new Message(Role::USER, 'How are you?')),
            ]
        )
    );

    if ($result->success()) {
        echo $result->getPrimaryAnswer(), PHP_EOL;
    } else {
        echo 'Error: ', $result->error->message, PHP_EOL;
    }
} catch (ConnectionException|DecoderException $e) {
    echo 'Error: ', $e->getMessage(), PHP_EOL;
}