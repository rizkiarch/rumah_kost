<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Pembayaran";
        $kontaks = Kontak::cursor();
        // dd($kontak);
        return view('dashboard.payment.create', [
            'title' => $title,
            'kontaks' => $kontaks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'kontak_id' => 'required',
                'tanggal_pembayaran' => 'required',
                'nominal' => 'required',
            ]);
            Payment::create($data);
            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('laporan.index')->with('Success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
            return redirect()->route('laporan.index')->with('Success', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $title = "Edit Pembayaran";
        // dd($kontak);
        $kontaks = Kontak::cursor();
        return view('dashboard.payment.edit', [
            'title' => $title,
            'kontaks' => $kontaks,
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        try {
            $data = $request->validate([
                'kontak_id' => 'required',
                'tanggal_pembayaran' => 'required',
                'nominal' => 'required',
            ]);
            $payment->update($data);
            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('laporan.index')->with('Success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message failed to send',
                'error' => $th->getMessage()
            ], 500);
            // toastr()->error('Data gagal disimpan!');
            // return redirect()->route('laporan.index')->with('Success', 'Data gagal ditambahkan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            toastr()->success('Data berhasil dihapus!');
            return redirect()->back()->with('Success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
            return redirect()->back()->with('Success', 'Data berhasil dihapus');
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Message failed to send',
            //     'error' => $th->getMessage()
            // ], 500);
        }
    }
}
