<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Offre;
use App\Form\OffreType; 
use App\Repository\OffreRepository;
use App\Repository\CandidatureRepository;
use App\Repository\ContratRepository;
use App\Repository\DomaineRepository;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $section = '';

        return $this->render('FrontOffice/home.html.twig',[
            "section" => $section,
            "isConnected" => true, 
        ]);
    }
/*
    #[Route('/home/{section}', name: 'app_home_other')]
    public function other($section): Response
    {

        return $this->render('FrontOffice/home.html.twig',[
            "section" => $section,
            "isConnected" => true, 
        ]);
    }*/
 
 
    #[Route('/home/offre_', name: 'app_home_off', methods: ['GET'])]
    public function off(OffreRepository $o,CandidatureRepository $c,CandidatureRepository $cp,CandidatureRepository $cr,CandidatureRepository $ca): Response
    {
        return $this->render('FrontOffice/Components/offreRedirect.html.twig');
    } 


/*
    #[Route('/home_offre_', name: 'app_home_off', methods: ['GET'])]
    public function off(OffreRepository $o,CandidatureRepository $c,CandidatureRepository $cp,CandidatureRepository $cr,CandidatureRepository $ca): Response
    {
       // OffreRepository $o;
      //  $o = new OffreRepository; 
        $offres= $o->findAll();
        $candidatures= $c->findAll();
        $candidaturesPending=$cp->findByStatus('Pending'); 
        $candidaturesAccepted=$ca->findByStatus('Acceptée'); 
        $candidaturesRejected=$cr->findByStatus('Rejetée'); 
        return $this->render('FrontOffice/Components/offreView.html.twig',[
       
            "isConnected" => true,                              
            'offres' => $o->findAll(),
            'candidatures' => $c->findAll(),
            'candidaturesPending' =>$cp->findByStatus('Pending'),
            'candidaturesAccepted' =>$ca->findByStatus('Acceptée'),
            'candidaturesRejected' =>$cr->findByStatus('Rejectée'),
        ]);

    }*/
    #[Route('/home/{section}', name: 'app_home_other', methods: ['GET'])]
    public function other($section,OffreRepository $o,CandidatureRepository $c,CandidatureRepository $cp,CandidatureRepository $cr,CandidatureRepository $ca,ContratRepository $con,DomaineRepository $dom): Response
    {
       // OffreRepository $o;
      //  $o = new OffreRepository; 
        $offres= $o->findAll();
        $candidatures= $c->findAll();
        $contrats= $con->findAll();
        $domaines= $dom->findAll();
        $candidaturesPending=$cp->findByStatus('Pending'); 
        $candidaturesAccepted=$ca->findByStatus('Acceptée'); 
        $candidaturesRejected=$cr->findByStatus('Rejetée'); 
        return $this->render('FrontOffice/home.html.twig',[
            "section" => $section,
            "isConnected" => true,                              
            'offres' => $o->findAll(),
            'contrats' => $con->findAll(),
            'domaines' => $dom->findAll(),
            'candidatures' => $c->findAll(),
            'candidaturesPending' =>$cp->findByStatus('Pending'),
            'candidaturesAccepted' =>$ca->findByStatus('Acceptée'),
            'candidaturesRejected' =>$cr->findByStatus('Rejetée'),
        ]);
    }



    


    /*
    #[Route('/home/offre', name: 'app_offre_index', methods: ['GET'])]
    public function show(OffreRepository $offreRepository): Response
    {
        return $this->render('FrontOffice/home.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }*/

    
}