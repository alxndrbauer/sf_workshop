<?php

declare(strict_types=1);

namespace App;

use App\HttpClient\CityClientInterface;
use App\ValueObjects\Weather;

class WeatherFetcher
{

    /**
     * @var iterable|CityClientInterface[]
     */
    private iterable $clients;

    public function __construct($clients)
    {
        $this->clients = $clients;
    }


    public function fetch(string $city): Weather
    {
        foreach ($this->clients as $client) {
            if (!$client->supports($city)) {
                continue;
            }

            return $client->request();
        }

        throw new \RuntimeException(sprintf('City "%s" is not supported', $city));
    }

}