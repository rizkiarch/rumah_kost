<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Kost";
        // $kontaks = collect();

        // Kontak::chunk(1000, function ($data) use ($kontaks) {
        //     $kontaks->push($data);
        // });
        $kosts = Kost::paginate(10);
        return view('dashboard.data_master.kost.index', [
            'title' => $title,
            'kosts' => $kosts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Buat Kost";
        return view('dashboard.data_master.kost.create', [
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
                'kode' => 'nullable',
                'nama_kost' => 'required',
                'nominal' => 'required',
                'keterangan' => 'nullable',
            ]);
            // $data['tanggal_masuk'] = Date::now()->toDateString();
            $kost = Kost::create($data);

            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('kost.index')->with('Success', 'Data berhasil ditambahkan');
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
    public function show(Kost $kost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kost $kost)
    {
        $title = "Edit Kost";
        return view('dashboard.data_master.kost.edit', [
            'title' => $title,
            'kost' => $kost
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kost $kost)
    {
        try {
            $data = $request->validate([
                'kode' => 'nullable',
                'nama_kost' => 'required',
                'nominal' => 'required',
                'keterangan' => 'nullable',
            ]);
            $kost->update($data);
            toastr()->success('Data berhasil diedit!');
            return redirect()->route('kost.index')->with('Success', 'Data berhasil Diedit');
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
     * Remove the specified resource from storage.
     */
    public function destroy(Kost $kost)
    {
        try {
            $kost->delete();
            toastr()->success('Data berhasil dihapus!');
            return redirect()->route('kost.index')->with('Success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
            return redirect()->route('kost.index')->with('Success', 'Data gagal dihapus');
        }
    }
}
