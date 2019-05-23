<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Note;
use App\Form\NoteType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class NoteController extends AbstractController {

    /**
     * @Route("/notes", name="note_index")
     * @IsGranted("ROLE_USER")
     */
    public function index() {
             
        $repository = $this->getDoctrine()->getRepository(Note::class);
        $user = $this->getUser();
        
        if(in_array("ROLE_ADMIN",$user->getRoles())){
            $notes = $repository->findAll();
        }
        else{
           $notes = $repository->findByUser($user);
        }
        
        return $this->render('note/index.html.twig', [
        'notes' => $notes,
        ]);
        }



    /**
     * @Route("/notes/new", name="note_new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        // Creamos objeto Note
        $note = new Note();

        $form = $this->createForm(NoteType::class, $note);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUser($this->getUser());

          // ... Aquí podríamos añadir la nota a bbdd
            $em->persist($note);
            $em->flush();

            $this->addFlash(
            'notice', 'Nota creada con éxito'
            );

            // Redirigimos a una pantalla diferente
            return $this->redirectToRoute('note_index');
        }

        return $this->render('note/new.html.twig', [
                    'form' => $form->createView(), 'note' => $note
        ]);
    }

    
    
    /**
     * @Route("/notes/edit/{id}", name="note_edit")
     */
    public function edit(Request $request, EntityManagerInterface $em, Note $note) {

        $this->denyAccessUnlessGranted('edit', $note);

        if (!$note) {
            throw $this->createNotFoundException(
                    'No se existe nota con id ' . $id
            );
        }

        /*
        $user = $this->getUser();
        if (!($note->getUser() === $user)) {

            $this->addFlash(
                    'error', 'ERROR: No estás autorizado para editar esta nota'
            );

            return $this->redirectToRoute('note_index');
        }*/

        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();

            $em->flush();
            // Redirigimos a una pantalla diferente
            return $this->redirectToRoute('note_index');
        }


        $this->addFlash(
                'notice', 'Nota actualizada con éxito'
        );


        return $this->render('note/edit.html.twig', [
                    'form' => $form->createView(), 'note' => $note
        ]);
    }

    
    
    
    /**
     * @Route("/notes/delete/{id}", name="note_delete")
     */
    public function delete(EntityManagerInterface $em, Note $note) {

        $this->denyAccessUnlessGranted('delete', $note);
        
        if (!$note) {
            throw $this->createNotFoundException(
                    'No se existe nota con id ' . $id
            );
        }
        $em->remove($note);
        $em->flush();

        $this->addFlash(
                'notice', 'Nota eliminada con éxito'
        );

        return $this->redirectToRoute('note_index');
    }

}
