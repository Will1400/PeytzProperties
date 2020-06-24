<?php

namespace App\Controller;

use App\Entity\Villa;
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
        $villaRepository = $entityManager->getRepository(Villa::class);


        $villas = $villaRepository->findBy(["ownerId" => $userId]);

        return $this->render("index.html.twig", [
            "villas" => $villas,
        ]);
    }
}
