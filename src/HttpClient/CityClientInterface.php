<?php

declare(strict_types=1);

namespace App\HttpClient;


use App\ValueObjects\Weather;

interface CityClientInterface
{
    public const BASE_URI = 'https://weather.titouangalopin.com/{}.json';

    public function request() : Weather;

    public function supports(string $city) : bool;
}