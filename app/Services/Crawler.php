<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Crawler
{
    public function crawl()
    {
        $url = 'https://www.immobilienscout24.de/Suche/shape/wohnung-mieten?shape=ZWhgX0l3e3NvQWZ9QXVhQmR7QG95Q2FjQXVfTntsQnd9Q3F4QF92R2tkQ3tpQF9yQm17QmttQW9Ud3lCYHtAbWtAdGNBY3VBantNZURkcVBsZUF_ZUJgYUxpYUB0ckFoYUBqYEF4dEE.&haspromotion=false&numberofrooms=3.5-&price=0.0-1600.0&livingspace=90.0-&exclusioncriteria=swapflat&pricetype=rentpermonth&sorting=2';

     
        $response = Http::get($url)->body();

        Storage::put('Response_' . date('Y-m-d_H:i:s') . '.log', $response);

        dd($response);

    }
}
