<?php

use PHPUnit\Framework\TestCase;
use TeeV\GptClient\Api\ChatParams;
use TeeV\GptClient\Api\Message;

/** @covers \TeeV\GptClient\Api\ChatParams */
class ChatParamsTest extends TestCase
{
    public function testGetParams(): void
    {
        $model = 'claudia schiffer';
        $messages = [
            Message::fromArray([
                'content' => 'hello',
                'role' => 'user',
                'name' => 'John Doe',
            ]),
            Message::fromArray([
                'content' => 'hi',
                'role' => 'system',
            ]),
        ];
        $chatParams = new ChatParams($model, $messages);
        $this->assertSame(['model' => $model, 'messages' => $messages], $chatParams->getParams());
    }
}