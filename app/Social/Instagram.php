<?php

namespace App\Social;

use Illuminate\Support\Facades\Cache;
use Vinkla\Instagram\Instagram as Insta;

/**
 * Instagram
 */
class Instagram
{
    private $instagram;
    private $key;
    private $expiresAt;

    public function __construct($key)
    {
        $this->key = $key;
        $this->expiresAt = now()->addDays(10);
        $instagram = $this->checkCache();

        return;
    }

    public function getInstagram()
    {
        return $this->instagram;
    }

    private function checkCache()
    {
        if (Cache::has($this->key)) {
            $this->instagram = Cache::get($this->key);

            return;
        }

        $this->setCache();

        return;
    }

    private function setCache()
    {
        $instagram = new Insta(config('instagram.token'));

        $insta_images = [];

        foreach ($instagram->media() as $image)
        {
            $insta_images[] = [
                'url' => $image->images->standard_resolution->url,
                'height' => $image->images->standard_resolution->height,
                'link' => $image->link,
                'caption' => optional($image->caption)->text
            ];
        }

        Cache::put($this->key, $insta_images, $this->expiresAt);
        $this->instagram = $insta_images;

        return;
    }
}
