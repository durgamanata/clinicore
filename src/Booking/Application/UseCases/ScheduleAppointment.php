<?php

declare(strict_types=1);

namespace Src\Booking\Application\UseCases;

use DateTimeImmutable;
use Src\Booking\Application\DTOs\ScheduleAppointmentRequest;
use Src\Booking\Domain\Models\Appointment;
use Src\Booking\Domain\Repositories\AppointmentRepository;
use Src\Booking\Domain\ValueObjects\AppointmentId;
use Src\Booking\Domain\ValueObjects\TimeSlot;

final class ScheduleAppointment
{
    private AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ScheduleAppointmentRequest $request): void
    {
        $id = new AppointmentId($request->id());
        
        $timeSlot = new TimeSlot(
            new DateTimeImmutable($request->startTime()),
            new DateTimeImmutable($request->endTime())
        );

        $appointment = Appointment::schedule($id, $timeSlot, new DateTimeImmutable());

        $this->repository->save($appointment);
    }
}