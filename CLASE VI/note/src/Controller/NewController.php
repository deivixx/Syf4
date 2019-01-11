<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class NewController extends AbstractController
{
    /**
     * @Route("/newresponse", name="new_response")
     */
    public function newResponse()
    {
        /*
        return $this->render('new/index.html.twig', [
            'controller_name' => 'NewController',
        ]);*/
        
        return new Response("<html><body><h1>Hola OpenWebinars</h1></body></html>");
    }


    /**
     * @Route("/new", name="new")
     */
    public function index()
    {
        
        return $this->render('new/index.html.twig', [
            'saludo' => 'Hola OpenWebinars',
        ]);
        
    }    
   
}
