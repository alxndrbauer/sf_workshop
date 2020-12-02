<?php

declare(strict_types=1);

namespace App\HttpClient;

use App\ValueObjects\Humidity;
use App\ValueObjects\Temperature;
use App\ValueObjects\Weather;
use App\ValueObjects\Wind;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ParisClient implements CityClientInterface
{
    private const CITY = 'paris';

    private HttpClientInterface $httpClient;

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
        $response = $this->httpClient->request('GET', str_replace('{}', self::CITY, self::BASE_URI));

        $content = $response->getContent();
        $content = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        return new Weather(
            new Temperature($content['temperature']),
            new Humidity($content['humidity']),
            new Wind($content['wind'])
        );
    }
}