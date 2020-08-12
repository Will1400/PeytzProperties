<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     *  @Route("/", name="home")
     */
    public function Index()
    {
        $userId = 0;
        if ($this->isGranted("IS_AUTHENTICATED_FULLY")) {
            $userId = $this->getUser()->getId();
        } else {
            $userId = -1;
        }

        $entityManager = $this->getDoctrine();
        $villaRepository = $entityManager->getRepository("App\Entity\Villa");
        $apartmentRepository = $entityManager->getRepository("App\Entity\Apartment");
        $condoRepository = $entityManager->getRepository("App\Entity\Condo");

        if ($userId == -1) {
            $villas = $villaRepository->findBy(["forSale" => 1]);
            $apartments = $apartmentRepository->findBy(["forSale" => 1]);
            $condos = $condoRepository->findBy(["forSale" => 1]);
        }
        else {
            $villas = $villaRepository->findBy(["ownerId" => $userId]);
            $apartments = $apartmentRepository->findBy(["ownerId" => $userId]);
            $condos = $condoRepository->findBy(["ownerId" => $userId]);
        }

        return $this->render("index.html.twig", [
            "villas" => $villas,
            "apartments" => $apartments,
            "condos" => $condos
        ]);
    }
}
