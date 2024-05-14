<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Jobs\Tagihan;
use App\Models\Jadwal;
use App\Models\Setting;
use App\Traits\WatsappTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Support\Facades\Date;

class TestController extends Controller
{
    use WatsappTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    // {
    //     $jadwalAktif = Jadwal::where('status', true)->get();
    //     $jadwalAktif = DB::table('jadwals')->where('status', 1)->get();

    //     dd($jadwalAktif);
    //     return view('test.index');
    // }
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
            $this->add_laporan($jadwal);
        }

        // $tanggal_hari_ini = Carbon::now();
        // if ($tanggal_hari_ini->format('Y-m-d') === '01-MM-YYYY') {
        //     $jadwalAktif->update([
        //         'jadwal_berulang' => 1
        //     ]);
        //     \Log::info("Berhasil Reset jadwal berulang " . date('Y-m-d H:i:s'));
        // }
    }
    public function hitung_tanggal_tagihan_berikutnya($tanggal_kirim)
    {
        $tanggal = Carbon::parse($tanggal_kirim);
        $addDay = $tanggal->addDays(30);

        $tanggal_tagihan_terakhir = $addDay;

        return $tanggal_tagihan_terakhir;
    }

    public function add_laporan($jadwal)
    {
        dd($jadwal);
        try {
            Jadwal::create([
                'jadwal_id' => $jadwal->id,
                'tanggal_kirim' => Carbon::now(),
                'status' => 1,
            ]);
            Log::info("Berhasil Membuat laporan " . date('Y-m-d H:i:s'));
        } catch (\Throwable $th) {
            Jadwal::create([
                'jadwal_id' => $jadwal->id,
                'tanggal_kirim' => Carbon::now(),
                'status' => 0,
            ]);
            Log::info("Gagal Membuat laporan " . date('Y-m-d H:i:s'));
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $db_setting = Setting::first();
            $message = $db_setting->format_text;
            $phone = $request->input('phone');
            // $phone = Setting::get('no_telpon');
            // $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;

            // $message = Setting::get('format_text');
            $result = $this->sendTextWatsapp($phone, $message);
            return response()->json([
                'status' => 'success',
                'message' => 'Message sent successfully',
                'result' => $result,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message failed to send',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateTagihanBerulang()
    {
        Tagihan::dispatch();

        return response()->json(['message' => 'Tagihan berulang telah diperbarui.']);
    }
}
