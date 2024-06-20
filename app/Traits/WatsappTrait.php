<?php

namespace App\Traits;

use App\Models\Setting;

trait WatsappTrait
{

    public function __construct()
    {
        //
    }

    public function sendTextWatsapp($phone, $message, $filePath)
    {
        $sender = Setting::latest()->value('no_telpon');
        $sender = preg_replace('/[^0-9]/', '', $sender);
        $sender = (str_starts_with($sender, '0')) ? '62' . substr($sender, 1) : $sender;

        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;

        $token = env('API_TOKEN_WATSAPP');
        $payload = [
            'api_key' => $token,
            'sender' => $sender,
            'number' => $phone,
            'message' => $message
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

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode != 200) { // Jika respons tidak berhasil (tidak 200 OK), maka jalankan sendMessages_Starsender
            return $this->sendMessages_Starsender($phone, $message, $filePath);
        }

        return $response; // tambahkan ini untuk mengembalikan respons dari curl
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

        $response = curl_exec($curl);
        curl_close($curl);

        return $response; // tambahkan ini untuk mengembalikan respons dari curl
    }

    public static function sendMessage($payload = [])
    {
        if (!is_array($payload)) {
            throw new \Exception("Payload must be an array", 400);
        }

        $url = env('DOMAIN_SERVER_WATSAPP_Jagad') . "/send-message";
        $email = env('EMAIL_SERVER_WATSAPP');
        $password =  env('PASSWORD_SERVER_WATSAPP');
        $credentials = base64_encode("$email:$password");
        $defaultHeaders = array_merge([
            "X-Requested-With: XMLHttpRequest",
            "Authorization: Basic $credentials"
        ]);


        if (isset($payload['attachment'])) {
            if (!file_exists($payload['attachment'])) {
                throw new \Exception("File not found", 404);
            }
            $full_path = realpath($payload['attachment']);
            $payload['attachment'] = new \CurlFile($full_path, mime_content_type($full_path), basename($full_path));
            $defaultHeaders = array_merge([
                "Content-Type: multipart/form-data"
            ], $defaultHeaders);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        // $payload = json_encode($payload);
        // dd($payload);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $defaultHeaders);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $hasil = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($hasil, true) ?? [];
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode == 200) {
            return $response['data'] ?? [];
        } else {
            throw new \Exception($response['message'] ?? "Failed to send message", $httpcode);
        }
    }

    public static function sendMessages_Starsender($phone, $message, $filePath)
    {
        $sender = Setting::latest()->value('no_telpon');
        $sender = preg_replace('/[^0-9]/', '', $sender);
        $sender = (str_starts_with($sender, '0')) ? '62' . substr($sender, 1) : $sender;

        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = (str_starts_with($phone, '0')) ? '62' . substr($phone, 1) : $phone;

        $apikey = env('API_KEY_STARSENDER');
        $pesan = rawurlencode($message);
        $tujuan = rawurlencode($phone . '@s.whatsapp.net');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . $pesan . '&tujuan=' . $tujuan,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('file' => curl_file_create($filePath)),
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apikey,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
