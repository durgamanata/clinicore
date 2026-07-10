<?php

declare(strict_types=1);

namespace Src\Booking\Infrastructure\Repositories;

use Src\Booking\Domain\Models\Appointment;
use Src\Booking\Domain\Repositories\AppointmentRepository;
use Src\Booking\Domain\ValueObjects\AppointmentId;

final class InMemoryAppointmentRepository implements AppointmentRepository
{
    /** @var array<string, Appointment> */
    private array $appointments = [];

    public function save(Appointment $appointment): void
    {
        $this->appointments[$appointment->id()->value()] = $appointment;
    }

    public function findById(AppointmentId $id): ?Appointment
    {
        return $this->appointments[$id->value()] ?? null;
    }
}