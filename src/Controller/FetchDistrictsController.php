<?php
declare(strict_types=1);

namespace App\Controller;

use App\Services\FetchDataInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FetchDistrictsController extends AbstractController
{
    /**
     * @Route("/districts/fetch", name="app_fetch_districts")
     */
    public function fetch(FetchDataInterface $fetchDistrictDataService): Response
    {
        $fetchDistrictDataService->fetch();

        return $this->redirectToRoute('app_show_all');
    }
}
