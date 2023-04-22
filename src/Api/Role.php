<?php
declare(strict_types=1);

namespace TeeV\GptClient\Api;
enum Role: string
{
  /** human */
  case USER = 'user';

  /** model */
  case ASSISTANT = 'assistant';

  /** context information */
  case SYSTEM = 'system';
}
