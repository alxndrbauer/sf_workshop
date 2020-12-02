<?php

declare(strict_types=1);

namespace App\Controller;

use App\WeatherFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/weather", name="weather_")
 */
class WeatherController extends AbstractController
{

    /**
     * @Route("/{city}", name="city")
     */
    public function index(string $city, WeatherFetcher $weatherFetcher) : JsonResponse
    {
        $weather = $weatherFetcher->fetch($city);

        return $this->json($weather->toArray());
    }
}
