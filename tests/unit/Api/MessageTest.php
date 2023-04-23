<?php

use PHPUnit\Framework\TestCase;
use TeeV\GptClient\Api\Message;
use TeeV\GptClient\Api\Role;

/** @covers \TeeV\GptClient\Api\Message */
class MessageTest extends TestCase
{
    public function testMessage(): void
    {
        $message = new Message(Role::USER, 'hello', 'John Doe');
        $this->assertSame([
            'role' => Role::USER->value,
            'content' => 'hello',
            'name' => 'John Doe',
        ], $message->getMessage());
    }
}