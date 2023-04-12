<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OffreRepository;

class BackController extends AbstractController
{
    
    #[Route('/dashboard/{getsion}', name: 'app_back_office')]
    public function backOffice($getsion): Response
    {
        return $this->render('BackOffice/back.html.twig',[
            "getsion" => $getsion,
        ]);
    }   /*
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
