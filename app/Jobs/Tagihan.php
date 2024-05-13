<?php

namespace App\Jobs;

use App\Models\Setting;
use App\Traits\WatsappTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class Tagihan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, WatsappTrait;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $jadwalAktif = Jadwal::where('status', 1)->with('kontak')->get();

        foreach ($jadwalAktif as $jadwal) {
            $tanggal_jadwal = Carbon::parse($jadwal->tanggal_kirim);
            $waktu_jadwal = $tanggal_jadwal->format('H:i:s');

            $tanggal_hari_ini = Carbon::now();
            $waktu_hari_ini = $tanggal_hari_ini->format('H:i:s');

            if ($tanggal_jadwal->isSameDay($tanggal_hari_ini)) {
                $tanggal_tagihan_berikutnya = $this->hitung_tanggal_tagihan_berikutnya($jadwal->tanggal_kirim);
                $jadwal->update(['tanggal_kirim' => $tanggal_tagihan_berikutnya]);

                $db_setting = Setting::first();
                $message = $db_setting->format_text;
                $phone = $jadwal->kontak->no_telpon;

                $this->sendTextWatsapp($phone, $message);
            }
        }
    }
    public function hitung_tanggal_tagihan_berikutnya($tanggal_kirim)
    {
        $tanggal = Carbon::parse($tanggal_kirim);
        $addDay = $tanggal->addDays(30);

        $tanggal_tagihan_terakhir = $addDay;

        return $tanggal_tagihan_terakhir;
    }
}
