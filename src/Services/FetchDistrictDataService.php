<?php
declare(strict_types=1);

namespace App\Services;

use App\Repository\DistrictRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchDistrictDataService
{
    private HttpClientInterface $httpClient;
    private GetDistrictDataService $getDistrictDataService;
    private DistrictRepository $districtRepository;

    /**
     * @param HttpClientInterface $httpClient
     * @param GetDistrictDataService $getDistrictDataService
     * @param DistrictRepository $districtRepository
     */
    public function __construct(
        HttpClientInterface $httpClient,
        GetDistrictDataService $getDistrictDataService,
        DistrictRepository $districtRepository
    ) {
        $this->httpClient = $httpClient;
        $this->getDistrictDataService = $getDistrictDataService;
        $this->districtRepository = $districtRepository;
    }


    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    public function fetch(): void
    {
        $response = $this->httpClient->request('GET', 'https://www.bip.krakow.pl/?bip_id=1&mmi=25540');

        $this->getDistrictDataService->setContent($response->getContent());

        for ($i = 25527; $i <= 25544; $i++) {
            $district = $this->getDistrictDataService->getData();
            $this->districtRepository->add($district);
        }
    }
}