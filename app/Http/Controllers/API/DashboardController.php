<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kontak;
use App\Models\Laporan;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch and count contacts
        $contactCount = Kontak::count();

        // Fetch and count schedules
        $scheduleCount = Jadwal::count();

        // Fetch and count reports
        $reportCount = Laporan::count();

        // Return the data as a JSON response
        return response()->json([
            'contactCount' => $contactCount,
            'scheduleCount' => $scheduleCount,
            'reportCount' => $reportCount
        ]);
    }

    public function getDashboardData()
    {
        // Fetch and count contacts
        $contactCount = Kontak::count();

        // Fetch and count schedules
        $scheduleCount = Jadwal::where('status', '1')->count();

        // Fetch and count reports
        $reportCount = Laporan::where('status', 'terkirim')->count();

        $tablePembayaran = Payment::with(['kontak'])->orderBy('id', 'desc')->paginate(5);

        // Return the data as a JSON response
        return response()->json([
            'contactCount' => $contactCount,
            'scheduleCount' => $scheduleCount,
            'reportCount' => $reportCount,
            'tablePembayaran' => $tablePembayaran->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
}
