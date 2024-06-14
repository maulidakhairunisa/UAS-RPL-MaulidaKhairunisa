<?php

class WeatherApp
{

    private $apiUrl;
    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getCuaca()
    {
        $dataCuaca = $this->getData();
        if ($dataCuaca) {
            return $this->parsedataCuaca($dataCuaca);
        } else {
            return false;
        }
    }

    private function getData()
    {
        $jsonData = file_get_contents($this->apiUrl);
        if ($jsonData) {
            return json_decode($jsonData, true);
        } else {
            return false;
        }
    }

    private function formatTimestamp($timestamp)
    {
        if (!$timestamp) {
            return false;
        }
        return date('l, d F Y H:i:s', $timestamp);
    }

    private function parsedataCuaca($dataCuaca)
    {
        $infoCuaca = [];
        $infoCuaca['coord'] = [
            'lon' => $dataCuaca['coord']['lon'],
            'lat' => $dataCuaca['coord']['lat']
        ];

        $infoCuaca['weather'] = [
            'main' => $dataCuaca['weather'][0]['main'],
            'description' => $dataCuaca['weather'][0]['description'],
            'icon' => $this->iconCuaca($dataCuaca['weather'][0]['main'])
        ];

        $infoCuaca['temp'] = $dataCuaca['main']['temp'];
        $infoCuaca['feels_like'] = $dataCuaca['main']['feels_like'];

        $infoCuaca['sys'] = [
            'sunrise'   => $this->formatTimestamp($dataCuaca['sys']['sunrise']),
            'sunset'    => $this->formatTimestamp($dataCuaca['sys']['sunset'])
        ];

        return $infoCuaca;
    }

    private function iconCuaca($weatherMain)
    {
        if (!$weatherMain) {
            return false;
        }
        $icons = [
            'Clear'         => 'img/sky-clear.png',
            'Clouds'        => 'img/clouds.png',
            'Rain'          => 'img/rain.png',
            'Thunderstorm'  => 'img/thunderstorm.png',
        ];
        $defaultIcon = 'clear.svg';
        return isset($icons[$weatherMain]) ? $icons[$weatherMain] : $defaultIcon;
    }
}
