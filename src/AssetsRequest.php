<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class AssetsRequest extends PaginatedRequest
{
    public function getUri(): string
    {
        return 'assets' . $this->getPagination();
    }
}
