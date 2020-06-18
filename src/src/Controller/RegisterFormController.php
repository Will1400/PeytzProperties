<?php

namespace App\Controller;

use App\Entity\RegistrationInfo;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $registration = new RegistrationInfo();

        $form = $this->createFormBuilder($registration)
            ->add("username", TextType::class)
            ->add("email", EmailType::class)
            ->add("password", PasswordType::class)
            ->add("register", SubmitType::class, ["label" => "Register"])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setEmail($registration->GetEmail());
            $user->setPassword($encoder->encodePassword($user, $registration->Getpassword()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->redirectToRoute("login");
        }

        return $this->render("security/register.html.twig", ["form" => $form->createView()]);
    }
}
