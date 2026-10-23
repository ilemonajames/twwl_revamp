<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CatalogDeletionService
{
    public function program(string $id): void
    {
        DB::transaction(function () use ($id) {
            $program = Program::lockForUpdate()->findOrFail($id);
            if (Appointment::where('program_id', $id)->exists() || Payment::where('program_id', $id)->exists()) {
                throw ValidationException::withMessages(['program' => 'Programs with appointment or payment history cannot be deleted.']);
            }
            $program->fees()->delete();
            $program->delete();
        });
    }

    public function service(string $id): void
    {
        DB::transaction(function () use ($id) {
            $service = Service::lockForUpdate()->findOrFail($id);
            if (Appointment::where('service_id', $id)->exists() || Payment::where('service_id', $id)->exists()) {
                throw ValidationException::withMessages(['service' => 'Services with appointment or payment history cannot be deleted.']);
            }
            $service->delete();
        });
    }
}
