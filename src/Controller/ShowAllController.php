<?php

namespace App\Controller;

use App\Form\FilterType;
use App\Repository\DistrictRepository;
use App\Services\DistrictFilter;
use App\Services\FilterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAllController extends AbstractController
{
    public const SORT_COLUMN_KEY    = 'sortColumn';
    public const SORT_DIRECTION_KEY = 'sortDirection';
    public const FILTER_KEY         = 'filter';
    public const FILTER_COLUMN_KEY= 'filterColumn';
    /**
     * @Route("/{sortColumn}/{sortDirection}/{filter}/{filterColumn}",
     *     name="app_show_all",
     *     methods={"GET"},
     *     defaults={"sortColumn"="id", "sortDirection"="ASC", "filter"="%", "filterColumn"="city"})
     */
    public function index(
        string $sortColumn,
        string $sortDirection,
        ?string $filter,
        string $filterColumn,
        Request $request,
        FilterService $filterService
    ): Response
    {

        $form = $this->createForm(FilterType::class);

        $data = [
            self::SORT_COLUMN_KEY => $sortColumn,
            self::SORT_DIRECTION_KEY => $sortDirection,
            self::FILTER_KEY => $filter,
            self::FILTER_COLUMN_KEY => $filterColumn
        ];

        $districtFilter = DistrictFilter::createFromArray($data);

        $districts = $filterService->filter($districtFilter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $districtFilter = DistrictFilter::createFromArray($data);

            return $this->redirectToRoute('app_show_all', [
                self::SORT_COLUMN_KEY => $districtFilter->getSortColumn(),
                self::SORT_DIRECTION_KEY=> $districtFilter->getSortDirection(),
                self::FILTER_KEY=> $districtFilter->getFilter() ?? '%',
                self::FILTER_COLUMN_KEY=> $districtFilter->getFilterColumn()
            ]);
        }

        return $this->render('show_all/index.html.twig', [
            'districts' => $districts,
            'form' => $form->createView()
        ]);
    }
}
