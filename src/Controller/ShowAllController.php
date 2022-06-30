<?php

namespace App\Controller;

use App\Form\FilterType;
use App\Repository\DistrictRepository;
use App\Services\FilterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAllController extends AbstractController
{
    /**
     * @Route("/{sortColumn}/{sortDirection}/{filter}/{filterColumn}",
     *     name="app_show_all",
     *     methods={"GET"},
     *     defaults={"sortColumn"="id", "sortDirection"="ASC", "filter"="%", "filterColumn"="city"})
     */
    public function index(Request $request, FilterService $filterService): Response
    {

        $form = $this->createForm(FilterType::class);

        $data = [
            'sortColumn' => $request->get('sortColumn'),
            'sortDirection' => $request->get('sortDirection'),
            'filter' => $request->get('filter'),
            'filterColumn' => $request->get('filterColumn')
        ];
        $districts = $filterService->filter($data);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('app_show_all', [
                'sortColumn' => $data['sortColumn'],
                'sortDirection' => $data['sortDirection'],
                'filter' => $data['filter'],
                'filterColumn' => $data['filterColumn']
            ]);
        }

        return $this->render('show_all/index.html.twig', [
            'districts' => $districts,
            'form' => $form->createView()
        ]);
    }
}
