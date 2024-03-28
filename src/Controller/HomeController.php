<?php

namespace App\Controller;

use \App\Repository\ClubRepository;
use App\Form\ClubType;
use \App\Entity\Club;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/club', name: 'club.home', methods:['GET'])]
    public function index(
        ClubRepository $repository, 
        PaginatorInterface $paginator, 
        Request $request
        ): Response
    {
        $clubs = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('home/index.html.twig', [
            'clubs' => $clubs
        ]);
    }

    #[Route('/club/nouveau', name: 'club.nouveau', methods:['GET', 'POST'])]
    public function nouveau(
        Request $request,
        EntityManagerInterface $manager
        ): Response
    {   
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $manager->persist($club);
            $manager->flush();

            return $this->redirectToRoute('club.home');
        }

        return $this->render('home/nouveau.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/club/update/{id}', name: 'club.update', methods:['GET', 'POST'])]
    public function update(
        Request $request,
        EntityManagerInterface $manager,
        Club $club,
        ): Response
    {   

        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $manager->persist($club);
            $manager->flush();
            
            return $this->redirectToRoute('club.home');
        }
        return $this->render('home/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/club/delete/{id}', name: 'club.delete', methods:['GET', 'POST'])]
    public function delete(
        EntityManagerInterface $manager,
        Club $club,
        ): Response
    {   

        $manager->remove($club);
        $manager->flush();

        return $this->redirectToRoute('club.home');
    }
}
