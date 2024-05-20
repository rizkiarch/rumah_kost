<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class KontakController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kontak";
        // $kontaks = collect();

        // Kontak::chunk(1000, function ($data) use ($kontaks) {
        //     $kontaks->push($data);
        // });
        $kontaks = Kontak::paginate(10);
        return view('dashboard.kontak.index', [
            'title' => $title,
            'kontaks' => $kontaks
        ]);
    }

    public function getJsonKontak()
    {
        try {
            $kontaks = []; // Initialize an empty array to store contacts

            Kontak::chunk(1000, function ($data) use (&$kontaks) {
                // Assuming 'data' contains an array of Kontakt objects
                foreach ($data as $kontak) {
                    // Extract relevant contact information (adjust based on your needs)
                    $contactData = [
                        'id' => $kontak->id,
                        'nama_lengkap' => $kontak->nama_lengkap,
                        'no_telpon' => $kontak->no_telpon,
                        // Add other relevant contact properties
                    ];
                    $kontaks[] = $contactData; // Add formatted data to the contacts array
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Contacts retrieved successfully',
                'data' => $kontaks, // Use 'data' instead of 'result' for clarity
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve contacts',
                'error' => $th->getMessage()
            ], 500);
        }
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
                'nik' => 'nullable||max:16',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tanggal_lahir' => 'nullable',
                'jenis_kelamin' => 'nullable',
                'agama' => 'nullable',
                'status_perkawinan' => 'nullable',
                'pekerjaan' => 'required',
                'no_telpon' => 'required',
                'tanggal_masuk' => 'required',
            ]);
            // $data['tanggal_masuk'] = Date::now()->toDateString();
            $kontak = Kontak::create($data);
            $this->add_jadwal($kontak);

            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
            return response()->json([
                'status' => 'error',
                'message' => 'Message failed to send',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function add_jadwal($kontak)
    {

        $dateNow = Carbon::now();
        $tanggal_kirim = $dateNow->addDays(30);
        Jadwal::create([
            'kontak_id' => $kontak->id,
            'tanggal_kirim' => $tanggal_kirim,
            'waktu_kirim' => Carbon::now()->format('H:i'),
            'status' => 0
        ]);
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
                'nik' => 'nullable||max:16',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tanggal_lahir' => 'nullable',
                'jenis_kelamin' => 'nullable',
                'agama' => 'nullable',
                'status_perkawinan' => 'nullable',
                'pekerjaan' => 'required',
                'no_telpon' => 'required',
                'tanggal_masuk' => 'required',
            ]);
            $kontak->update($data);
            toastr()->success('Data berhasil diedit!');
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil Diedit');
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
    public function destroy(Kontak $kontak)
    {
        try {
            $kontak->delete();
            toastr()->success('Data berhasil dihapus!');
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
            return redirect()->route('kontak.index')->with('Success', 'Data berhasil dihapus');
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Message failed to send',
            //     'error' => $th->getMessage()
            // ], 500);
        }
    }
}
