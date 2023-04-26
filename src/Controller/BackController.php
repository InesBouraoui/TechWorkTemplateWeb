<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OffreRepository;
use App\Repository\CandidatureRepository;
use App\Entity\Offre;
use App\Entity\Candidature;
use App\Entity\Domaine;
use App\Entity\Contrat;
class BackController extends AbstractController
{
    
    #[Route('/dashboard/{getsion}', name: 'app_back_office')]
    public function backOffice($getsion,OffreRepository $offreRepository,CandidatureRepository $candidatureRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $countt = $em->getRepository(Offre::class)->createQueryBuilder('o')
            ->select('COUNT(o)')
            ->getQuery()
            ->getSingleScalarResult();
        
        
        $em = $this->getDoctrine()->getManager();
        $countt2 = $em->getRepository(Candidature::class)->createQueryBuilder('o')
            ->select('COUNT(o)')
            ->getQuery()
            ->getSingleScalarResult();

        $em = $this->getDoctrine()->getManager();
        $countt4 = $em->getRepository(Domaine::class)->createQueryBuilder('o')
            ->select('COUNT(o)')
            ->getQuery()
            ->getSingleScalarResult();


        $em = $this->getDoctrine()->getManager();
        $countt3 = $em->getRepository(Contrat::class)->createQueryBuilder('o')
            ->select('COUNT(o)')
            ->getQuery()
            ->getSingleScalarResult();

        // On va chercher toutes les catégories
        $offre = $offreRepository->findAll();
        //OFFRE par candidature
        $categColor  = [];
        $categNomOff = [];
        $categCountOff = [];
        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($offre as $off){
            $categNomOff[] = $off->getTitre();
            $categCountOff[] = count($off->getCandidatures());
 
        }


        // On va chercher le nombre de candidatures par date
        $bysmth = $candidatureRepository->countByDate();

        $dates = [];
        $candidaturesCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($bysmth as $can){
            $dates[] = $can['datePostulation'];
            $candidaturesCount[] = $can['count'];
        }


        // On va chercher le nombre d'offres par domaine
        $cby = $offreRepository->countByDomaine();

        $smth = [];
        $cbyCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($cby as $ind){
            $smth[] = $ind['cbysmth'];
            $cbyCount[] = $ind['count'];
        }


        // On va chercher le nombre d'offres par domaine
        $cby2 = $offreRepository->countByContrat();

        $smth2 = [];
        $cbyCount2 = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($cby2 as $ind2){
            $smth2[] = $ind2['cbysmth2'];
            $cbyCount2[] = $ind2['count'];
        }

/*
        $ales = $candidatureRepository->countByDate();

        $dates = [];
        $candidaturesCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($bysmth as $can){
            $dates[] = $can['dateAnnonces'];
            $candidaturesCount[] = $can['count'];
        }



*/
        // On va chercher toutes les catégories
        $offre = $offreRepository->findAll();
        //OFFRE par CONTRAT 
        $categNomOff3 = []; 
        $categCountOff3 = [];
        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($offre as $off3){
            $categNomOff3[] = $off3->getContrat()->getNom();
            $categCountOff3[] = count($off3->getCandidatures());
        }

        //CANDIDATURE
        /*
        $findall = $candidatureRepository->findAll();
        $categNomCan = [];
        $categColorCan = [];
        $categCountCan = [];
        
        foreach($findall as $j){
            $categNomCan[] = $j->getCandidat();
       //      $categCountCan[] = count($j->getCandidat());
            $categColorCan[] = "red";

        }*/





 

        return $this->render('BackOffice/back.html.twig', [
            "getsion" => $getsion,

            'countt' => $countt,
            'countt2' => $countt2,
            'countt3' => $countt3,
            'countt4' => $countt4,

            'categColor' => json_encode($categColor),

            'categNomOff' => json_encode($categNomOff),
            'categCountOff' => json_encode($categCountOff),

            'dates' => json_encode($dates),
            'candidaturesCount' => json_encode($candidaturesCount),

            'smth' => json_encode($smth),
            'cbyCount' => json_encode($cbyCount),

            'smth2' => json_encode($smth2),
            'cbyCount2' => json_encode($cbyCount2),

        //    'categNomOff2' => json_encode($categNomOff2), 
          //  'categCountOff2' => json_encode($categCountOff2),

      /*      'categNomOff3' => json_encode($categNomOff3), 
            'categCountOff3' => json_encode($categCountOff3),*/


        ]);
    }
    
    
    
    
    
    
    
    
    
    /*
    #[Route('/dashboard/{getsion}', name: 'app_back_office')]
    public function backOffice($getsion): Response
    {
        return $this->render('BackOffice/back.html.twig',[
            "getsion" => $getsion,
        ]);
    } */



    /*
    #[Route('/dashboard/{getsion}', name: 'app_back_office', methods: ['GET'])]
    public function backOffice($getsion,OffreRepository $offreRepository): Response
    {
        return $this->render('BackOffice/back.html.twig',[
            "getsion" => $getsion, 'offres' => $offreRepository->findAll(),
        ]);
    }
*/
    #[Route('/dashboard', name: 'app_back_office_index')]
    public function backOfficeindex(): Response
    {
        return $this->render('BackOffice/back.html.twig',[
            "getsion" => "",
        ]);
    }
}
