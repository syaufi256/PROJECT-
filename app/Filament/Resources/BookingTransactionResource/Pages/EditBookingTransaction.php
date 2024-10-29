<?php

namespace App\Filament\Resources\BookingTransactionResource\Pages;

use App\Filament\Resources\BookingTransactionResource;
use App\Models\WorkshopParticipant;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditBookingTransaction extends EditRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Fetch existing participants and add them to the form data
        $data['participants'] = $this->record->participants->map(function (WorkshopParticipant $participant) {
            return [
                'name' => $participant->name,
                'occupation' => $participant->occupation,
                'email' => $participant->email,
            ];
        })->toArray();

        return $data;
    }

    protected function afterSave(): void
    {
        DB::transaction(function () {
            $record = $this->record;

            // Hapus data peserta yang sudah ada untuk menghindari duplikasi
            $record->participants()->delete();

            // Ambil data participants dari state form
            $participants = $this->form->getState()['participants'] ?? [];

            // Pastikan participants adalah array dan tidak kosong
            if (is_array($participants) && !empty($participants)) {
                // Iterasi setiap peserta dan buat catatan di tabel workshop_participants
                foreach ($participants as $participant) {
                    WorkshopParticipant::create([
                        'workshop_id' => $record->workshop_id,
                        'booking_transaction_id' => $record->id,
                        'name' => $participant['name'],
                        'occupation' => $participant['occupation'],
                        'email' => $participant['email'],
                    ]);
                }
            }
        });
    }
}