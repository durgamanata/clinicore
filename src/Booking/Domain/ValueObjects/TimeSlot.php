<?php

declare(strict_types=1);

namespace Src\Booking\Domain\ValueObjects;

use DateTimeImmutable;
use InvalidArgumentException;

final class TimeSlot
{
    private DateTimeImmutable $start;
    private DateTimeImmutable $end;

    public function __construct(DateTimeImmutable $start, DateTimeImmutable $end)
    {
        if ($start >= $end) {
            throw new InvalidArgumentException('The start time must be before the end time.');
        }

        $this->start = $start;
        $this->end = $end;
    }

    public function start(): DateTimeImmutable
    {
        return $this->start;
    }

    public function end(): DateTimeImmutable
    {
        return $this->end;
    }
}