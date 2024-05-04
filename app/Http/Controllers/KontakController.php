<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Setting;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kontak";
        $kontak = Kontak::paginate(10);
        return view('dashboard.kontak.index', [
            'title' => $title,
            'kontaks' => $kontak
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Kontak";
        return view('dashboard.kontak.create', [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nik' => 'required||max:16',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'no_telpon' => 'required',
            ]);
            $kontak = Kontak::create($data);
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil ditambahkan');
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
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kontak $kontak)
    {
        $title = "Edit Kontak";
        // dd($kontak);
        return view('dashboard.kontak.edit', [
            'title' => $title,
            'penghuni' => $kontak
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kontak $kontak)
    {
        try {
            $data = $request->validate([
                'nik' => 'required||max:16',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'no_telpon' => 'required',
            ]);
            $kontak->update($data);
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil Diedit');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message failed to send',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak)
    {
        try {
            $kontak->delete();
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message failed to send',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
