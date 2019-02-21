<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Note;
use Symfony\Component\HttpFoundation\Request;
use App\Form\NoteType;

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


    /**
     * @Route("/notes/new", name="note_new")
     */
    public function new(Request $request)
    {
        // Creamos objeto Note
        $note = new Note();
        
        $form = $this->createForm(NoteType::class, $note);

        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() Contiene los datos enviados
            $note = $form->getData();

            
            // ... Aquí podríamos añadir la nota a bbdd
            
            // Redirigimos a una pantalla diferente
            //return $this->redirectToRoute('note_home');
        }
                
        return $this->render('note/new.html.twig', [
            'form' => $form->createView(),'note'=>$note
        ]);
    }
}
