<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use stdClass;

class Response
{
    public function __construct(protected stdClass $json)
    {
    }
}
