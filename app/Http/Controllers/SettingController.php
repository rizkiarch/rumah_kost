<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pengaturan";
        $setting = Setting::first();
        return view('dashboard.pengaturan.index', [
            'title' => $title,
            'setting' => $setting
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
        $data = [
            'format_text' => $request->input('format_text'),
            'no_telpon' => $request->input('no_telpon')
        ];
        // dd($data);
        $setting_nomor = Setting::where('no_telpon', $data['no_telpon'])->first();
        $setting_format_text = Setting::where('format_text', $data['format_text'])->first();
        if ($setting_nomor) {
            $setting_nomor->format_text = $data['format_text'];
            $setting_nomor->save();
        } elseif ($setting_format_text) {
            $setting_format_text->no_telpon = $data['no_telpon'];
            $setting_format_text->save();
        } else {
            Setting::updateOrInsert($data);
        }


        return redirect()->route('setting.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
