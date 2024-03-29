<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    #[Route('/', name: 'security.login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('/security/login.html.twig', [
            'lastUsername' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
         ]);
    }

    #[Route('/deconnexion', name: 'security.logout')]
    public function logout()
    {
        # code...
    }

    #[Route('/registration', name: 'security.registration', methods:['GET', 'POST'])]
    public function registration(EntityManagerInterface $manager, Request $request):Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }

        return $this->render('/security/registration.html.twig', [
            'form' => $form->createView()
         ]);
    }
}
