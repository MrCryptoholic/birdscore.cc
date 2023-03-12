<?php

namespace App\Http\Controllers;

use App\Models\BirdScore;

class BirdScoreController extends Controller
{
    /**
     * @var BirdScore $birdScore
     */
    protected BirdScore $birdScore;

    /**
     * @param BirdScore $birdScore
     */
    public function __construct(BirdScore $birdScore)
    {
        $this->birdScore = $birdScore;
    }

    /**
     * @param string $handle
     *
     * @return string
     */
    public function score(string $handle): string
    {
        return $this->birdScore->getScore($handle);
    }
}
