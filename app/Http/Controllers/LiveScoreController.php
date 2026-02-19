<?php

namespace App\Http\Controllers;

use App\Services\LiveScoreService;

class LiveScoreController extends Controller
{
    protected $liveScoreService;

    public function __construct(LiveScoreService $liveScoreService)
    {
        $this->liveScoreService = $liveScoreService;
    }

    public function index()
    {
        $scores = $this->liveScoreService->getLiveScores();
        return view('livescores', compact('scores'));
    }
}
