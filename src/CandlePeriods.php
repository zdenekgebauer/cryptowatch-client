<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class CandlePeriods
{
    public const ONE_MINUTE = '60',
        THREE_MINUTES = '180',
        FIVE_MINUTES = '300',
        FIFTEEN_MINUTES = '900',
        THIRTY_MINUTES = '1800',
        ONE_HOUR = '3600',
        TWO_HOURS = '7200',
        FOUR_HOURS = '14400',
        SIX_HOURS = '21600',
        TWELVE_HOURS = '43200',
        ONE_DAY = '86400',
        THREE_DAYS = '259200',
        ONE_WEEK = '604800',
        ONE_WEEK_MONDAY = '604800_Monday';
}
