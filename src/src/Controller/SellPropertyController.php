<?php

namespace App\Controller;

use App\Entity\Apartment;
use App\Entity\Condo;
use App\Entity\Villa;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SellPropertyController extends AbstractController
{

    /**
     *  @Route("/property/sell/{propertyType}", name="property_sell")
     */
    public function Index(Request $request, string $propertyType = "default")
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if (!in_array($propertyType, ["Villa", "Apartment", "Condo", false])) {
            return $this->render("Property/Sell.html.twig", ["error" => "Select a property type"]);
        }

        if ($propertyType == "Villa")
            $property = new Villa();
        else if ($propertyType == "Apartment")
            $property = new Apartment();
        else {
            $property = new Condo();
        }

        $user = $this->getUser();
        $property->setOwnerId($user->getId());

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(PropertyType::class, $property, ["propertyType" => $propertyType]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($property);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("home"));
        }
        return $this->render("Property/Sell.html.twig", ["form" => $form->createView(), "error" => ""]);
    }
}
