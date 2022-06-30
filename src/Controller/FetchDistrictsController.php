<?php
declare(strict_types=1);

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

        return $this->redirectToRoute('app_show_all');
    }
}
