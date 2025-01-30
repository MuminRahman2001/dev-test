<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BreedController extends Controller
{
    public function index(): JsonResponse
    {
        $url = 'https://api.thecatapi.com/v1/breeds';

        $headers = [
            'Content-Type' => 'application/json',
            'x-api-key' => env('API_CAT')
        ];

        $response = Http::withHeaders($headers)->get($url);

        if ($response->successful()) {
            return response()->json([
                'data' => $response->json()
            ]);
        } else {
            return response()->json('error has occurred', 400);
        }
    }

    public function searchBreed(Request $request): JsonResponse
    {
        $url = 'https://api.thecatapi.com/v1/breeds/search';

        $headers = [
            'Content-Type' => 'application/json',
            'x-api-key' => env('API_CAT')
        ];

        $param = [
            'q' => $request->input('breed')
        ];

        $response = Http::withHeaders($headers)->get($url, $param);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'data' => $data
            ], 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json('error has occurred', 400);
        }
    }

    public function getBreed($id)
    {
        $url = 'https://api.thecatapi.com/v1/breeds/'. $id;

        $headers = [
            'Content-Type' => 'application/json',
            'x-api-key' => env('API_CAT')
        ];

        $response = Http::withHeaders($headers)->get($url);

        // You can now pass the breed data to a view
        if ($response->successful()) {
            $breedData = $response->json();
            $imageId = $breedData['reference_image_id'] ?? null;

            $imageUrl = null;
            if ($imageId) {
                // Make another request to get the image URL
                $imageResponse = Http::withHeaders($headers)->get("https://api.thecatapi.com/v1/images/{$imageId}");

                if ($imageResponse->successful()) {
                    $imageData = $imageResponse->json();
                    $imageUrl = $imageData['url'] ?? null;
                }
            }

            return view('breed-details', compact('breedData', 'imageUrl'));
        } else {
            return response()->json('error has occurred', 400);
        }
    }

}
