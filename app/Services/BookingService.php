<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\ProgramFee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function price(string $program): int
    {
        $fee = ProgramFee::where('program_id', $program)->first();
        if (! $fee) {
            throw ValidationException::withMessages(['program' => 'Pricing is not available for this program.']);
        }
        $amount = MoneyAmount::minor($fee->program_fees)
            + MoneyAmount::minor($fee->session_fees)
            + MoneyAmount::minor($fee->consultation_fees);
        if ($amount <= 0) {
            throw ValidationException::withMessages(['program' => 'Please contact us to book this program.']);
        }

        return $amount;
    }

    public function lockCalendarDates(array $dates): void
    {
        $locks = [];
        foreach ($dates as $date) {
            foreach ([-1, 0, 1] as $offset) {
                $locks[] = Carbon::parse($date)->addDays($offset)->toDateString();
            }
        }
        $locks = array_unique($locks);
        sort($locks);
        foreach ($locks as $date) {
            DB::table('booking_calendar_locks')->insertOrIgnore(['date' => $date]);
            DB::table('booking_calendar_locks')->where('date', $date)->lockForUpdate()->first();
        }
    }

    private function assertAvailable(string $date, string $time, ?int $except = null): void
    {
        $start = Carbon::parse($date.' '.$time);
        $duration = (int) config('booking.duration_minutes', 120);
        $conflict = Appointment::whereBetween('appointment_date', [$start->copy()->subDay()->toDateString(), $start->copy()->addDay()->toDateString()])
            ->when($except, fn ($query) => $query->whereKeyNot($except))
            ->whereRaw("LOWER(status) NOT IN ('cancelled', 'canceled', 'failed', 'closed')")
            ->where(function ($query) {
                $query->where('status', '!=', 'pending_payment')
                    ->orWhereNull('reserved_until')->orWhere('reserved_until', '>', now());
            })->get()->contains(function ($appointment) use ($start, $duration) {
                $existing = Carbon::parse($appointment->appointment_date->toDateString().' '.$appointment->appointment_time);

                return $start->lt($existing->copy()->addMinutes($duration))
                    && $start->copy()->addMinutes($duration)->gt($existing);
            });
        if ($conflict) {
            throw ValidationException::withMessages(['appointment_time' => 'This time overlaps an existing appointment. Please choose another time.']);
        }
    }

    public function reserve(array $data, ?string $userId, bool $onlinePayment = false): Appointment
    {
        Validator::make($data, [
            'program_id' => 'required|uuid|exists:programs,id',
            'appointment_date' => 'required|date_format:Y-m-d|after:today',
            'appointment_time' => 'required|date_format:H:i',
        ])->validate();

        return DB::transaction(function () use ($data, $userId, $onlinePayment) {
            $this->lockCalendarDates([$data['appointment_date']]);
            $this->assertAvailable($data['appointment_date'], $data['appointment_time']);

            return Appointment::create(array_merge($data, [
                'user_id' => $userId, 'service_id' => $data['service_id'] ?? null,
                'amount_minor' => $this->price($data['program_id']),
                'status' => $onlinePayment ? 'pending_payment' : 'pending',
                'reserved_until' => $onlinePayment ? now()->addMinutes(15) : null,
            ]));
        }, 3);
    }

    public function reschedule(Appointment $appointment, array $data): Appointment
    {
        Validator::make($data, [
            'appointment_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'consulation_link' => 'required|url:http,https|max:2048',
        ])->validate();

        return DB::transaction(function () use ($appointment, $data) {
            $this->lockCalendarDates([$appointment->appointment_date->toDateString(), $data['appointment_date']]);
            $appointment = Appointment::lockForUpdate()->findOrFail($appointment->id);
            if (in_array($appointment->status, ['pending_payment', 'payment_processing', 'payment_review'], true)) {
                throw ValidationException::withMessages(['payment' => 'Resolve this appointment payment before changing its schedule.']);
            }
            $this->assertAvailable($data['appointment_date'], $data['appointment_time'], $appointment->id);
            $appointment->update($data + ['status' => 'scheduled']);

            return $appointment->fresh();
        }, 3);
    }
}
