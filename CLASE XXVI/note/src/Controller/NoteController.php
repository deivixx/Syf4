<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Note;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Note::class);
        $notes = $repository->findSQL("huevos");
        
        return $this->render('note/index.html.twig', [
            'notes' => $notes,
        ]);
    }
}
