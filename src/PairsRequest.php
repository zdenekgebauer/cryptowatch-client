<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class PairsRequest extends PaginatedRequest
{
    public function getUri(): string
    {
        return 'pairs' . $this->getPagination();
    }
}
