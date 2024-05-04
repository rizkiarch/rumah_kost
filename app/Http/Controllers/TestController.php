<?php

namespace App\Http\Controllers;

use App\Traits\WatsappTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

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
}
