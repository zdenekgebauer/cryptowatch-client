<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

abstract class PaginatedRequest extends Request
{
    public function __construct(protected ?string $cursor = null, protected ?int $limit = null)
    {
    }

    public function getPagination(): string
    {
        $data = [];
        if ($this->cursor !== null) {
            $data['cursor'] = $this->cursor;
        }
        if ($this->limit > 0) {
            $data['limit'] = $this->limit;
        }
        if (empty($data)) {
            return '';
        }
        return '?' . http_build_query($data);
    }

    abstract public function getUri(): string;
}
