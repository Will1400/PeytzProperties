<?php

namespace App\Controller;

use App\Form\PropertyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditPropertyController extends AbstractController
{
    /**
     *  @Route("/property/edit/{propertyType}/{propertyId}", name="property_edit")
     */
    public function Index(Request $request, string $propertyType = "default", string $propertyId = "default")
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if (!is_numeric($propertyId) && !in_array($propertyType, ["Villa", "Apartment", "Condo", false])) {
            return $this->render("Property/Edit.html.twig", ["error" => "Property not found"]);
        }

        $entityManager = $this->getDoctrine()->getManager();

        $repository = $entityManager->getRepository("App\Entity\\" . $propertyType);
        $property = $repository->findOneBy(["id" => $propertyId]);

        if (is_null($property)) {
            return $this->render("Property/Edit.html.twig", ["error" => "Property not found"]);
        } else {
            $form = $this->createForm(PropertyType::class, $property, ["propertyType" => $propertyType]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
                return $this->redirect($this->generateUrl("home"));
            }
        }
        return $this->render("Property/Edit.html.twig", ["form" => $form->createView(), "error" => "", "propertyType" => $propertyType, "propertyId" => $propertyId]);
    }
}
