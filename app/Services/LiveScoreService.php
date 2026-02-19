<?php 


namespace App\Services;

use Illuminate\Support\Facades\Http;

class LiveScoreService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('FOOTBALL_API_URL');
        $this->apiKey = env('FOOTBALL_API_KEY');
    }

    public function getLiveScores()
    {
        $response = Http::withHeaders([
            'X-Api-Key' => $this->apiKey
        ])->get("{$this->apiUrl}/fixtures", [
            'live' => 'all'
        ]);

        return $response->json();
    }
}
