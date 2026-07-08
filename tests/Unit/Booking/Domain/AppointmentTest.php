<?php

declare(strict_types=1);

use Src\Booking\Domain\Models\Appointment;
use Src\Booking\Domain\ValueObjects\AppointmentId;
use Src\Booking\Domain\ValueObjects\TimeSlot;

test('it can schedule a valid appointment', function () {
    $id = new AppointmentId('2a0487c6-2c96-419b-a010-062e7421c382');
    $now = new DateTimeImmutable('2026-07-08 12:00:00');
    $timeSlot = new TimeSlot(
        new DateTimeImmutable('2026-07-08 14:00:00'),
        new DateTimeImmutable('2026-07-08 15:00:00')
    );

    $appointment = Appointment::schedule($id, $timeSlot, $now);

    expect($appointment->id()->value())->toBe('2a0487c6-2c96-419b-a010-062e7421c382');
    expect($appointment->status()->value())->toBe('pending');
});

test('it cannot schedule an appointment in the past', function () {
    $id = new AppointmentId('2a0487c6-2c96-419b-a010-062e7421c382');
    $now = new DateTimeImmutable('2026-07-08 12:00:00');
    $timeSlot = new TimeSlot(
        new DateTimeImmutable('2026-07-08 10:00:00'),
        new DateTimeImmutable('2026-07-08 11:00:00')
    );

    Appointment::schedule($id, $timeSlot, $now);
})->throws(DomainException::class, 'Cannot schedule an appointment in the past.');