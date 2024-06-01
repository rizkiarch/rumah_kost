<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Laporan;
use App\Models\Payment;
use App\Models\Setting;
use App\Traits\WatsappTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LaporanController extends Controller
{
    use WatsappTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Laporan";



        $laporans = Laporan::with(['jadwal'])->orderBy('id', 'desc')->paginate(5);
        $payments = Payment::with(['kontak'])->orderBy('tanggal_pembayaran', 'desc')->paginate(5);
        return view('dashboard.laporan.index', [
            'title' => $title,
            'laporans' => $laporans,
            'payments' => $payments
        ]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        try {
            $phone = $laporan->jadwal->kontak->no_telpon;
            $db_setting = Setting::first();
            $message = $db_setting->format_text;
            $payload = [
                'phone' => $phone,
                'message' => $message
            ];
            $laporan->update([
                'tanggal_terkirim' => Date::now(),
                'status' => 'terkirim'
            ]);

            try {
                $this->sendMessage($payload);
            } catch (\Throwable $th) {
                $this->sendTextWatsapp($phone, $message);
            }
            toastr()->success('Data berhasil dikirim ulang!');
            return redirect()->route('laporan.index')->with('Success', 'Data berhasil dikirim ulang');
        } catch (\Throwable $th) {
            $laporan->update([
                'tanggal_terkirim' => Date::now(),
                'status' => 'pending'
            ]);
            toastr()->error('Data gagal dikirim ulang!');
            return redirect()->route('laporan.index')->with('Error', 'Data gagal dikirim ulang'); //throw $th;
        }
    }
    // {
    //     // try {
    //     //     $laporan = Laporan::updateOrCreate(
    //     //         [
    //     //             'tanggal_terkirim' => Date::now(),
    //     //             'status' => 'terkirim'
    //     //         ]
    //     //     );
    //     //     toastr()->success('Data berhasil dikirim ulang!');
    //     //     return redirect()->route('laporan.index')->with('Success', 'Data berhasil dikirim ulang');
    //     // } catch (\Throwable $th) {
    //     //     //throw $th;
    //     // }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
