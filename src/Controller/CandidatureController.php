<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\RawMessage;
use Symfony\Component\Mime\Email;
 
use Symfony\Component\Mime\Address;  
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

  

 

#[Route('/candidature')]
class CandidatureController extends AbstractController
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    #[Route('/', name: 'app_candidature_index', methods: ['GET'])]
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
        ]);
    }
    

 


    #[Route('/new', name: 'app_candidature_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CandidatureRepository $candidatureRepository,MailerInterface $mailer): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

 

// Create the email message
$email = (new Email())
    ->from('ines.bouraoui@esprit.tn')
    ->to('bouraouines7@gmail.com')
    ->subject('Test email')
    ->text('This is a test email sent from Symfony.');

// Send the email
//$mailer->send($email);
$this->mailer->send($email);


            $candidature->setDatepostulation(new \DateTime());
            $candidature->setStatus('Pending');
            $candidature->setDetails('-');
            $candidatureRepository->save($candidature, true);

            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidature/new.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }
 

     
    #[Route('/{id}', name: 'app_candidature_show', methods: ['GET'])]
    public function show(Candidature $candidature): Response
    {
        return $this->render('candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    #[Route('_edit/{id}', name: 'app_candidature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository,MailerInterface $mailer ): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);
 

        if ($form->isSubmitted() && $form->isValid()) {

       //     $email="bouraouines5@gmail.com";
      
      //      $uppcode="abc";
            
    //        $this->SendCodeMail($email,$mailer,$uppcode);


            $candidature->setDatemodification(new \DateTime());
 

            
            $candidatureRepository->save($candidature, true);
 
            
 
        
            $email = (new Email())
            ->from('ines.bouraoui@esprit.tn')
            ->to('bouraouines5@gmail.com')
            ->subject('Candidature Updated')
            ->text(sprintf(
                'The candidature with ID %d has been updated at %s',
                $candidature->getId(),
                $candidature->getDatemodification()->format('Y-m-d H:i:s')
            ));
        
       // $this->mailer->send($email);
 


            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
     


         //   $session=$request->getSession();
          //  $session->set('email',$email);
           // $session->set('codepwd',$uppcode);

            // Get the email address of the user who submitted the form
         //   $adresseemail = $candidature->getCandidat()->getEmail();


     /*       $email = (new Email()) 
        ->from('ines.bouraoui@esprit.tn')
        ->to($adresseemail)
        
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again!');
      //  ->html('<p>See Twig integration for better HTML integration!</p>');
     
        $mailer->send($email);
     //   var_dump($mailer);


*/

        }/*

#[Route('_edit/{id}', name: 'app_candidature_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository): Response
{
    $form = $this->createForm(CandidatureType::class, $candidature);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

 
        $candidature->setDatemodification(new \DateTime());


        
        $candidatureRepository->save($candidature, true);
 
            
            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }
*/
 


    #[Route('/{id}', name: 'app_candidature_delete', methods: ['POST'])]
    public function delete(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $candidatureRepository->remove($candidature, true);
        }

        return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
    }


 
}
