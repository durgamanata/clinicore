<?php

declare(strict_types=1);

use Src\Booking\Application\DTOs\ScheduleAppointmentRequest;
use Src\Booking\Application\UseCases\ScheduleAppointment;
use Src\Booking\Infrastructure\Repositories\InMemoryAppointmentRepository;
use Src\Booking\Domain\ValueObjects\AppointmentId;

test('it schedules an appointment successfully', function () {
    $repository = new InMemoryAppointmentRepository();
    $useCase = new ScheduleAppointment($repository);

    $request = new ScheduleAppointmentRequest(
        '2a0487c6-2c96-419b-a010-062e7421c382',
        '2026-07-10 10:00:00',
        '2026-07-10 11:00:00'
    );

    $useCase->execute($request);

    $savedAppointment = $repository->findById(
        new AppointmentId('2a0487c6-2c96-419b-a010-062e7421c382')
    );

    expect($savedAppointment)->not->toBeNull();
    expect($savedAppointment->status()->value())->toBe('pending');
});