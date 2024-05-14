<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kontak;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Atur Jadwal Pesan";
        $jadwals = Jadwal::with('kontak')->get();
        $kontaks = Kontak::with('jadwal')->get();
        // dd($jadwals);
        return view('dashboard.jadwal.index', [
            'title' => $title,
            'jadwals' => $jadwals,
            'kontaks' => $kontaks
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
        try {
            $validatedData = request()->validate([
                'kontak_id' => 'required',
                'status' => 'required',
                'tanggal_kirim' => 'required',
                'waktu_kirim' => 'required',
            ]);

            $jadwal = Jadwal::updateOrCreate(
                ['kontak_id' => $validatedData['kontak_id']],
                $validatedData
            );

            $jadwal->update();
            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('jadwal.index')->with('Success', 'Data berhasil Diperbarui');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
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
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // try {
        //     $request->validate([
        //         'kontak_id' => 'required',
        //         'status' => 'required',
        //         'tanggal_masuk' => 'required',
        //     ]);

        //     $kontak = Kontak::findOrFail($id);
        //     $kontak->kontak_id = $request->kontak_id;
        //     $kontak->status = $request->status;
        //     $kontak->tanggal_masuk = $request->tanggal_masuk;
        //     $kontak->save($data);
        //     return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Message failed to send',
        //         'error' => $th->getMessage()
        //     ], 500);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
