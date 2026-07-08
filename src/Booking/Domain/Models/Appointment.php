<?php

declare(strict_types=1);

namespace Src\Booking\Domain\Models;

use DateTimeImmutable;
use DomainException;
use Src\Booking\Domain\ValueObjects\AppointmentId;
use Src\Booking\Domain\ValueObjects\AppointmentStatus;
use Src\Booking\Domain\ValueObjects\TimeSlot;

final class Appointment
{
    private AppointmentId $id;
    private TimeSlot $timeSlot;
    private AppointmentStatus $status;

    private function __construct(
        AppointmentId $id,
        TimeSlot $timeSlot,
        AppointmentStatus $status
    ) {
        $this->id = $id;
        $this->timeSlot = $timeSlot;
        $this->status = $status;
    }

    public static function schedule(
        AppointmentId $id,
        TimeSlot $timeSlot,
        DateTimeImmutable $now
    ): self {
        if ($timeSlot->start() < $now) {
            throw new DomainException('Cannot schedule an appointment in the past.');
        }

        return new self($id, $timeSlot, AppointmentStatus::pending());
    }

    public function id(): AppointmentId
    {
        return $this->id;
    }

    public function timeSlot(): TimeSlot
    {
        return $this->timeSlot;
    }

    public function status(): AppointmentStatus
    {
        return $this->status;
    }
}