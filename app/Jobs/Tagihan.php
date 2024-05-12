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
        $jadwalAktif = DB::table('jadwals')->where('status', 1)->get();
        // dd($jadwalAktif);
        foreach ($jadwalAktif as $jadwal) {
            $tanggal_tagihan_berikutnya = $this->hitung_tanggal_tagihan_berikutnya($jadwal);
            $jadwal->update(['jadwal_kirim' => $tanggal_tagihan_berikutnya]);
            $db_setting = Setting::first();
            $message = $db_setting->format_text;
            $phone = $db_setting->no_telpon;
            // $phone = Setting::get('no_telpon');
            // $message = Setting::get('format_text');
            $this->sendTextWatsapp($phone, $message);
        }
    }

    public function hitung_tanggal_tagihan_berikutnya($jadwal)
    {
        $intervalDetik = $jadwal->jadwal_berulang * 60;

        $tanggal_tagihan_terakhir = $jadwal->jadwal_kirim;

        $tanggal_tagihan_terakhir = Carbon::parse($tanggal_tagihan_terakhir)->addSeconds($intervalDetik);
        // dd($tanggal_tagihan_terakhir);
        return $tanggal_tagihan_terakhir;
    }
}
