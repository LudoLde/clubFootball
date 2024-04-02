<?php

namespace App\Controller;

use \App\Repository\JoueurRepository;
use App\Form\JoueurType;
use \App\Entity\Joueur;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class JoueurController extends AbstractController
{
    #[Route('/joueur', name: 'joueur.accueil', methods:['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function index(Request $request,
    PaginatorInterface $paginator,
    JoueurRepository $repository 
    ): Response
    {
        $joueurs = $paginator->paginate(
        $repository->findAll(),
        $request->query->getInt('page', 1),
        15
        );
        return $this->render('joueur/accueil.html.twig', [
            'joueurs' => $joueurs
        ]);
    }

    #[Route('/joueur/new', name: 'joueur.nouveau', methods:['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function new(Request $request, EntityManagerInterface $manager ): Response
    {   
        $joueur = new Joueur();
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $joueur = $form->getData();

            $manager->persist($joueur);
            $manager->flush();

            return $this->redirectToRoute('joueur.accueil');
        }

        return $this->render('joueur/nouveau.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/joueur/update/{id}', name: 'joueur.update', methods:['GET', 'POST'])]
    public function update(Request $request, 
    EntityManagerInterface $manager, 
    Joueur $joueur, 
    int $id,
    JoueurRepository $repository 
    ): Response
    {   

        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $joueur = $form->getData();

            $manager->persist($joueur);
            $manager->flush();

            return $this->redirectToRoute('joueur.accueil');
           
        }

        return $this->render('joueur/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/joueur/delete/{id}', name: 'joueur.delete', methods:['GET', 'POST'])]
    public function delete(
        EntityManagerInterface $manager, 
    Joueur $joueur
    ): Response
    {   
        $manager->remove($joueur);
        $manager->flush();

        return $this->redirectToRoute('joueur.accueil');
    }
}
