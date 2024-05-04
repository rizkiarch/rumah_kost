<?php

namespace App\Traits;

use App\Models\Setting;

trait WatsappTrait
{

    public function __construct()
    {
        $this->sender = Setting::latest()->value('no_telpon');
        $this->sender = preg_replace('/[^0-9]/', '', $this->sender);
        $this->sender = (str_starts_with($this->sender, '0')) ? '62' . substr($this->sender, 1) : $this->sender;
    }

    public function sendTextWatsapp($phone, $message)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;
        $token = env('API_TOKEN_WATSAPP');
        $payload = [
            'api_key' => $token,
            'sender' => $this->sender,
            'number' => $phone,
            'message' => $message . ' ' . date('Y-m-d')
        ];


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('DOMAIN_SERVER_WATSAPP') . "/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        )); // tambahkan kurung tutup di sini

        $result = curl_exec($curl);
        curl_close($curl);

        return $result; // tambahkan ini untuk mengembalikan respons dari curl
    }

    public static function sendMediaWatsapp($phone, $message)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;

        $token = env('API_TOKEN_WATSAPP');
        $media = 'http://repository.untag-sby.ac.id/712/3/BAB%202.pdf';
        $payload = [
            'api_key' => $token,
            'sender' => $this->sender,
            'number' => $phone,
            'media_type' => 'pdf',
            'caption' => $message,
            'url' => $media,
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('DOMAIN_SERVER_WATSAPP') . "/send-media",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        )); // tambahkan kurung tutup di sini

        $result = curl_exec($curl);
        curl_close($curl);

        return $result; // tambahkan ini untuk mengembalikan respons dari curl
    }
}
