<?php

namespace App\Http\Controllers;

class ExternalApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://events-happened-in-world.p.rapidapi.com/search?date=5&month=4&limit=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: events-happened-in-world.p.rapidapi.com",
                // Consume key from .env for security purpose
                "X-RapidAPI-Key: " . config('services.event.key')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
        }

        return view('external_api', compact('data'));
    }
}
