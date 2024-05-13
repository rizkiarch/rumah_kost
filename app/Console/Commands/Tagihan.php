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
            $tanggal_jadwal = Carbon::parse($jadwal->jadwal_kirim);
            $waktu_jadwal = $tanggal_jadwal->format('H:i:s');

            $tanggal_hari_ini = Carbon::now();
            $waktu_hari_ini = $tanggal_hari_ini->format('H:i:s');

            if ($tanggal_jadwal->isSameDay($tanggal_hari_ini)) {
                $tanggal_tagihan_berikutnya = $this->hitung_tanggal_tagihan_berikutnya($jadwal->jadwal_kirim);
                $jadwal->update(['jadwal_kirim' => $tanggal_tagihan_berikutnya]);

                $db_setting = Setting::first();
                $message = $db_setting->format_text;
                $phone = $jadwal->kontak->no_telpon;

                $this->sendTextWatsapp($phone, $message);
            }
        }
    }
    public function hitung_tanggal_tagihan_berikutnya($jadwal_kirim)
    {
        $tanggal = Carbon::parse($jadwal_kirim);
        $addDay = $tanggal->addDays(30);

        $tanggal_tagihan_terakhir = $addDay;

        return $tanggal_tagihan_terakhir;
    }
}
