<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeletePropertyController extends AbstractController
{
    /**
     *  @Route("/property/delete/{propertyType}/{propertyId}", name="property_delete")
     */
    public function Index(string $propertyType = "default", string $propertyId = "default")
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if (!is_numeric($propertyId) && !in_array($propertyType, ["Villa", "Apartment", "Condo", false])) {
            return $this->redirect($this->generateUrl("home"));
        }

        $entityManager = $this->getDoctrine()->getManager();

        $repository = $entityManager->getRepository("App\Entity\\" . $propertyType);
        $property = $repository->findOneBy(["id" => $propertyId]);

        if (!is_null($property)) {
            $entityManager->remove($property);
            $entityManager->flush();
        }
        return $this->redirect($this->generateUrl("home"));
    }
}
