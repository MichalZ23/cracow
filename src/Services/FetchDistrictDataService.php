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
    private DistrictService $districtService;

    /**
     * @param HttpClientInterface    $httpClient
     * @param GetDistrictDataService $getDistrictDataService
     * @param DistrictRepository     $districtRepository
     * @param DistrictService        $districtService
     */
    public function __construct(
        HttpClientInterface $httpClient,
        GetDistrictDataService $getDistrictDataService,
        DistrictRepository $districtRepository,
        DistrictService $districtService
    ) {
        $this->httpClient = $httpClient;
        $this->getDistrictDataService = $getDistrictDataService;
        $this->districtRepository = $districtRepository;
        $this->districtService = $districtService;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    public function fetch(): void
    {
        for ($i = 25527; $i <= 25544; $i++) {
            $response = $this->httpClient->request('GET', "https://www.bip.krakow.pl/?bip_id=1&mmi=$i");
            $district = $this->getDistrictDataService->getData($response->getContent());
            if (!($fetchedDistrict = $this->districtRepository->checkIfDistrictExists($district))) {
                $this->districtRepository->add($district);
            } else if (!$district->equals($fetchedDistrict)) {
//                dump($district);exit();
                $this->districtService->updateDistrict($fetchedDistrict, $district->toArray());
            }
        }
    }
}