<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use stdClass;

class PaginatedResponse extends Response
{
    public function __construct(protected stdClass $json)
    {
        parent::__construct($this->json);
    }

    public function getCursor(): string
    {
        return $this->json->cursor->last;
    }

    public function hasMore(): bool
    {
        return $this->json->cursor->hasMore;
    }
}
