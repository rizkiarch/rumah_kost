<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Setting;
use App\Traits\WatsappTrait;
use Illuminate\Console\Command;

class Tagihan extends Command
{
    use WatsappTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tagihan:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim Tagihan';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $jadwalAktif = Jadwal::where('status', 1)->with('kontak')->get();

        foreach ($jadwalAktif as $jadwal) {
            $tanggal_jadwal = Carbon::parse($jadwal->tanggal_kirim);
            $waktu_jadwal = $jadwal->waktu_kirim;

            $tanggal_hari_ini = Carbon::now();
            $waktu_hari_ini = $tanggal_hari_ini->format('H:i:s');

            if ($tanggal_jadwal->isSameDay($tanggal_hari_ini) && $waktu_jadwal >= $waktu_hari_ini) {
                $db_setting = Setting::first();
                $message = $db_setting->format_text;
                $phone = $jadwal->kontak->no_telpon;

                $tanggal_tagihan_berikutnya = $this->hitung_tanggal_tagihan_berikutnya($jadwal->tanggal_kirim);
                $this->sendTextWatsapp($phone, $message);
                $jadwal->update([
                    'tanggal_kirim' => $tanggal_tagihan_berikutnya,
                    'jadwal_berulang' => 0,
                ]);
                \Log::info("Berhasil Mengirim Tagihan di jalankan " . date('Y-m-d H:i:s'));
            }
        }

        $tanggal_hari_ini = Carbon::now();
        if ($tanggal_hari_ini->format('Y-m-d') === '01-MM-YYYY') {
            $jadwalAktif->update([
                'jadwal_berulang' => 1
            ]);
            \Log::info("Berhasil Reset jadwal berulang " . date('Y-m-d H:i:s'));
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
