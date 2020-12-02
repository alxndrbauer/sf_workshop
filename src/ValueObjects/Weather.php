<?php

declare(strict_types=1);

namespace App\ValueObjects;

class Weather
{

    private Temperature $temperature;

    private Humidity $humidity;

    private ?Wind $wind;

    public function __construct(Temperature $temperature, Humidity $humidity, ?Wind $wind)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->wind = $wind;
    }

    public function getTemperature() : Temperature
    {
        return $this->temperature;
    }

    public function getHumidity() : Humidity
    {
        return $this->humidity;
    }

    public function getWind() : ?Wind
    {
        return $this->wind;
    }


    public function toArray() : array
    {
        return [
            'temperature' => $this->getTemperature()->getValue(),
            'humidity' => $this->getHumidity()->getValue(),
            'weather' => $this->getWind() ? $this->getWind()->getValue() : null,
        ];
    }

}