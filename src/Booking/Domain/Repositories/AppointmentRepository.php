<?php

declare(strict_types=1);

namespace Src\Booking\Domain\Repositories;

use Src\Booking\Domain\Models\Appointment;
use Src\Booking\Domain\ValueObjects\AppointmentId;

interface AppointmentRepository
{
    public function save(Appointment $appointment): void;

    public function findById(AppointmentId $id): ?Appointment;
}