<?php

namespace App\Controller;

use App\Entity\District;
use App\Form\DistrictType;
use App\Repository\DistrictRepository;
use App\Services\DistrictService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/district")
 */
class DistrictController extends AbstractController
{
    /**
     * @Route("/add", name="app_add_district")
     */
    public function addDistrictAction(Request $request, DistrictService $districtService): Response
    {
        $form = $this->createForm(DistrictType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $districtService->addDistrict($form->getData());

            return $this->redirectToRoute('app_show_all');
        }

        return $this->render('district/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_delete_district", methods={"DELETE"})
     */
    public function deleteDistrictAction(int $id, DistrictRepository $districtRepository): Response
    {
        $district = $districtRepository->findOneBy(['id' => $id]);
        $districtRepository->remove($district);

        return new RedirectResponse($this->generateUrl('app_show_all'));
    }

    /**
     * @Route("/update/{id}", name="app_update_district")
     * @ParamConverter("id", class="App\Entity\District", options={"id" = "id"})
     */
    public function updateDistrictAction(Request $request, District $district, DistrictService $districtService): Response
    {
        $form = $this->createForm(DistrictType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $districtService->updateDistrict($district, $form->getData());

            return $this->redirectToRoute('app_show_all');
        }

        return $this->render('district/index.html.twig', [
            'name' => $district->getName(),
            'form' => $form->createView()
        ]);
    }
}
