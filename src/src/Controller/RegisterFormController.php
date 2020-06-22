<?php

namespace App\Controller;

use App\Entity\RegistrationInfo;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterFormController extends AbstractController
{
    /**
     *  @Route("/register", name="register")
     */
    public function Register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->Getpassword()));

            $entityManager = $this->getDoctrine()->getManager();

            $repository = $entityManager->getRepository(User::class);

            $newUser = $repository->findOneBy(['email' => $user->getEmail(),]);

            if (!is_null($newUser)) {
                return $this->render("security/register.html.twig", [
                    "form" => $form->createView(),
                    "error" => "Email already in use."
                ]);
            }

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute("/login");
        }

        return $this->render("security/register.html.twig", ["form" => $form->createView()]);
    }
}
