<?php

declare(strict_types=1);

namespace App\HttpClient;

use App\ValueObjects\Humidity;
use App\ValueObjects\Temperature;
use App\ValueObjects\Weather;
use App\ValueObjects\Wind;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BerlinClient implements CityClientInterface
{

    private HttpClientInterface $httpClient;

    private const CITY = 'berlin';

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function supports(string $city) : bool
    {
        return mb_strtolower($city) === self::CITY;
    }

    public function request() : Weather
    {
        $response = $this->httpClient->request('GET', str_replace('{}',self::CITY, self::BASE_URI));

        $content = $response->getContent();
        $content = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        if (!array_key_exists('measure', $content)) {
            throw new \RuntimeException('...');
        }

        $measure = $content['measure'];

        return new Weather(
            new Temperature($measure['temp']),
            new Humidity($measure['humidity']),
            new Wind($measure['wind'])
        );
    }
}