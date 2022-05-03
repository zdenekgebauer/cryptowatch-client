<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

abstract class Request
{
    abstract public function getUri(): string;
}
