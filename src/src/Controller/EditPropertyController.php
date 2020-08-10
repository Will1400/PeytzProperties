<?php

namespace App\Controller;

use App\Entity\Villa;
use App\Form\VillaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditPropertyController extends AbstractController
{
    /**
     *  @Route("/property/edit/{propertyId}", name="property_edit")
     */
    public function Index(Request $request, string $propertyId = "default")
    {
        if (!is_numeric($propertyId)) {
            return $this->render("Property/Edit.html.twig", ["error" => "No villa found"]);
        }

        $entityManager = $this->getDoctrine()->getManager();

        $repository = $entityManager->getRepository(Villa::class);
        $villa = $repository->findOneBy(["id" => $propertyId]);

        if (is_null($villa)) {
            $villa = new Villa();
            return $this->render("Property/Edit.html.twig", ["error" => "No villa found"]);
        }

        $form = $this->createForm(VillaType::class, $villa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirect($this->generateUrl("home"));
        }

        return $this->render("Property/Edit.html.twig", ["form" => $form->createView(), "error" => ""]);
    }
}
