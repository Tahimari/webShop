<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $contactFormData = $form->getData();
            
            $message = (new \Swift_Message('You Got Mail!'))
                    ->setFrom($contactFormData['from'])
                    ->setTo('kamilm215@gmail.com')
                    ->setBody(
                            $contactFormData['message'],
                            'text/plain'
                            );
            
            $mailer->send($message);
            
            $this->addFlash('success', 'It sent!');
            
            return $this->redirectToRoute('contact');
        }
        
        return $this->render('contact/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }
 
}
