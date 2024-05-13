<?php

namespace App\Listeners;

use App\Models\Jadwal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class KontakCreatedListener
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(KontakCreated  $event): void
    {
        Jadwal::create([
            'kontak_id' => $event->kontak->id,
            // 'tanggal_kirim' => now(), // Anda dapat mengatur waktu sesuai kebutuhan
            'status' => 0,
        ]);
    }
}
