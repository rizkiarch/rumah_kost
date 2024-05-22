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
    {
        return view('test.index');
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
            $headers = $request->headers->all();
            $payload = [
                'phone' => $phone,
                'message' => $message
            ];
            // $phone = Setting::get('no_telpon');
            // $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;

            // $message = Setting::get('format_text');
            $result = $this->sendMessage($payload, $headers);
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
