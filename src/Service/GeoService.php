<?php


namespace App\Service;

use App\Entity\Problems;
use App\Repository\ProblemsRepository;
use Exception;
use GuzzleHttp\Client;

class GeoService
{
    private $problemsRepository;

    public function __construct(ProblemsRepository $problemsRepository)
    {
        $this->problemsRepository = $problemsRepository;
    }

    /**
     * Transforms any proper address to coordinates
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function geocode(Problems $problem)
    {

        $street = $problem->getAddress();
        $zipCode = $problem->getZipCode();
        $city = $problem->getCity();

        $address = $street . " " . $zipCode . " " . $city;

        $client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
        ]);

        $response = $client->request('GET', 'search.php?q='
            . urlencode($address)
            . '&format=json');

        $body = $response->getBody();
        $obj = json_decode($body->getContents(), true);
        if (isset($obj[0])) {
            $latitude = $obj[0]['lat'];
            $longitude = $obj[0]['lon'];
            $problem->setLon($longitude)
                ->setLat($latitude);
        } else {
            throw new Exception("L'adresse saisie est invalide, veuillez réessayer");
        }
    }
}
