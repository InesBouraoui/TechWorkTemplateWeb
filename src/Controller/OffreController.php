<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidature;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use App\Form\PostulerType;
class OffreController extends AbstractController
{
    public function count()
    {  
        // 1. Obtain doctrine manager
        $em = $this->getDoctrine()->getManager();
        
        // 2. Setup repository of some entity
        $repoOffres = $em->getRepository(Offre::class);
        
        // 3. Query how many rows are there in the Articles table
        $totalOffres = $repoOffres->createQueryBuilder('a')
            // Filter by some parameter if you want
            // ->where('a.published = 1')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
        
        // 4. Return a number as response
        // e.g 972
        return new Response($totalOffres);
    }


    

    #[Route('dashboard/offre', name: 'app_back_offre_show', methods: ['GET'])]
    public function showBack(OffreRepository $offreRepository): Response
    {
        return $this->render('BackOffice\Components\offre_show.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }

  
/*

 
    #[Route('/offre', name: 'app_offre_index', methods: ['GET'])]
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('offre/index.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }

*/
 
#[Route('/offre', name: 'app_offre_index', methods: ['GET'])]
public function index(OffreRepository $offreRepository): Response
{


    
    return $this->render('offre/index.html.twig', [
        'offres' => $offreRepository->findAll(),
    ]);
}

    #[Route('/offre/new', name: 'app_offre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OffreRepository $offreRepository): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offre->setStatus('Disponible');
            $offreRepository->save($offre, true);

            return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    #[Route('/offre/{id}', name: 'app_offre_show', methods: ['GET'])]
    public function show(Offre $offre): Response
    {
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
        ]);
    }
/*
    #[Route('/offre/postuler/{id}', name: 'app_offre_show_postuler', methods: ['GET'])]
    public function show_postuler(Offre $offre): Response
    {
        return $this->render('FrontOffice/Components/offrePostuler.html.twig', [
            'offre' => $offre,
        ]);
    }
*/
#[Route('/home/offre/{id}', name: 'app_offre_show_postuler', methods: ['GET', 'POST'])]
public function show_postuler(Offre $offre,Request $request, CandidatureRepository $candidatureRepository): Response
{
    $candidature = new Candidature();
    $form = $this->createForm(PostulerType::class, $candidature);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $candidature->setDatepostulation(new \DateTime());
        $candidature->setStatus('Pending');
        $candidature->setOffre($offre);
        $candidatureRepository->save($candidature, true);

        return $this->redirectToRoute('app_home_off', [], Response::HTTP_SEE_OTHER);
    }
    return $this->renderForm('FrontOffice/Components/offrePostuler.html.twig', [
        'offre' => $offre,
        'candidature' => $candidature,
        'form' => $form,
    ]);
}

 

 
    #[Route('/offre_edit/{id}', name: 'app_offre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
   
            $offreRepository->save($offre, true);

            return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }
 
    
    #[Route('/offre/{id}', name: 'app_offre_delete', methods: ['POST'])]
    public function delete(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $offreRepository->remove($offre, true);
        }

        return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/stats", name="stats")
     */
    public function statistiques(OffreRepository $categRepo, AnnoncesRepository $annRepo){
        // On va chercher toutes les catégories
        $offre = $categRepo->findAll();

        $categNom = [];
        $categColor = [];
        $categCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($offre as $off){
            $categNom[] = $off->getName();
            $categColor[] = $off->getColor();
            $categCount[] = count($off->getAnnonces());
        }

 

        return $this->render('admin/stats.html.twig', [
            'categNom' => json_encode($categNom),
            'categColor' => json_encode($categColor),
            'categCount' => json_encode($categCount),
   
        ]);
    }

}
