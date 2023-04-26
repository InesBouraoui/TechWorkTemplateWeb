<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Form\DomaineType;
use App\Repository\DomaineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/domaine')]
class DomaineController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
 
    #[Route('/', name: 'app_domaine_index', methods: ['GET'])]
    public function index(DomaineRepository $domaineRepository): Response
    {
        return $this->render('domaine/index.html.twig', [
            'domaines' => $domaineRepository->findAll(),
        ]);
    }
    /*
    #[Route('/', name: 'app_domaine_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Domaine $domaine, DomaineRepository $domaineRepository): Response
    {  $form = $this->createForm(DomaineType::class, $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $domaineRepository->save($domaine, true);

            return $this->redirectToRoute('app_domaine_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('domaine/index.html.twig', [
            'domaines' => $domaineRepository->findAll(),            'domaine' => $domaine,
            'form' => $form,
        ]);
    } */



    #[Route('/new', name: 'app_domaine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DomaineRepository $domaineRepository): Response
    {
        $domaine = new Domaine();
        $form = $this->createForm(DomaineType::class, $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $domaineRepository->save($domaine, true);

            return $this->redirectToRoute('app_domaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('domaine/new.html.twig', [
            'domaine' => $domaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_domaine_show', methods: ['GET'])]
    public function show(Domaine $domaine): Response
    {
        return $this->render('domaine/show.html.twig', [
            'domaine' => $domaine,
        ]);
    }

    #[Route('_edit/{id}', name: 'app_domaine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Domaine $domaine, DomaineRepository $domaineRepository): Response
    {
    //    $offre = $entityManager->getRepository(Offre::class)->find($offreId);
        $form = $this->createForm(DomaineType::class, $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $domaineRepository->save($domaine, true);

            return $this->redirectToRoute('app_domaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('domaine/edit.html.twig', [
            'domaine' => $domaine,
            'form' => $form,
           /* 'offre' => $offre,*/
        ]);
    }

    #[Route('/{id}', name: 'app_domaine_delete', methods: ['POST'])]
    public function delete(Request $request, Domaine $domaine, DomaineRepository $domaineRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$domaine->getId(), $request->request->get('_token'))) {
            $domaineRepository->remove($domaine, true);
        }

        return $this->redirectToRoute('app_domaine_index', [], Response::HTTP_SEE_OTHER);
    }
}
