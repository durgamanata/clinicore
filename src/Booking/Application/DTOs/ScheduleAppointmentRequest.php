<?php

declare(strict_types=1);

namespace Src\Booking\Application\DTOs;

final class ScheduleAppointmentRequest
{
    private string $id;
    private string $startTime;
    private string $endTime;

    public function __construct(string $id, string $startTime, string $endTime)
    {
        $this->id = $id;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function startTime(): string
    {
        return $this->startTime;
    }

    public function endTime(): string
    {
        return $this->endTime;
    }
}