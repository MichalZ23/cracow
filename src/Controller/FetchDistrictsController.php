<?php

namespace App\Controller;

use App\Services\FetchDistrictDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchDistrictsController extends AbstractController
{
    /**
     * @Route("/districts/fetch", name="app_fetch_districts")
     */
    public function fetch(FetchDistrictDataService $fetchDistrictDataService): Response
    {
        $fetchDistrictDataService->fetch();

        return $this->render('fetch_districts/index.html.twig', [
            'controller_name' => 'FetchDistrictsController',
        ]);
    }
}
