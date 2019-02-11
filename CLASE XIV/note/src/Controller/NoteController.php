<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/home", name="note_home")
     */
    public function home()
    {
        return $this->render('note/home.html.twig');
    }
    
    
    
    /**
     * @Route("/notes", name="note_index")
     */
    public function noteIndex()
    {
        return $this->render('note/index.html.twig');
    }



}
