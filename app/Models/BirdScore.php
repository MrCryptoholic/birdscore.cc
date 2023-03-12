<?php

namespace App\Models;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class BirdScore
{
    /**
     * @var Application $app
     */
    protected Application $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $twitterHandle
     *
     * @return string
     */
    public function getScore(string $twitterHandle): string
    {
        if (Cache::has($twitterHandle)) {
            return Cache::get($twitterHandle);
        }

        $twitterScore = $this->fetchScore($twitterHandle);

        Cache::add($twitterHandle, $twitterScore, now()->addDays(7));

        return (string)round($twitterScore);
    }

    /**
     * @param string $twitterHandle
     *
     * @return string
     */
    protected function fetchScore(string $twitterHandle): string
    {
        $response = Http::get($this->app['config']->get('services.twitterscore.url'), [
            'api_key' => $this->app['config']->get('services.twitterscore.key'),
            'username' => $twitterHandle
        ]);

        $twitterScore = $response['twitter_score'];

        return (string)round($twitterScore);
    }
}
