<?php

declare(strict_types=1);

namespace Src\Booking\Domain\ValueObjects;

use InvalidArgumentException;

final class AppointmentStatus
{
    private const PENDING = 'pending';
    private const CONFIRMED = 'confirmed';
    private const CANCELLED = 'cancelled';

    private const ALLOWED = [
        self::PENDING,
        self::CONFIRMED,
        self::CANCELLED,
    ];

    private string $value;

    private function __construct(string $value)
    {
        if (!in_array($value, self::ALLOWED, true)) {
            throw new InvalidArgumentException(sprintf('Invalid status: %s', $value));
        }

        $this->value = $value;
    }

    public static function pending(): self
    {
        return new self(self::PENDING);
    }

    public static function confirmed(): self
    {
        return new self(self::CONFIRMED);
    }

    public static function cancelled(): self
    {
        return new self(self::CANCELLED);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }
}