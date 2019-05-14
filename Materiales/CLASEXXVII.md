## DOCTRINE - PERSISTENCIA, ACTUALIZACIÓN Y BORRADO



Creamos método para añadir notas:
Para insertar, modificar o eliminar un dato de bbdd desde el controlador, necesitamos acceder el manager de base de datos:
  

    $entityManager  =  $this->getDoctrine()->getManager();

También podemos añadirlo como argumento en el método correspondiente *(EntityManagerInterface $entityManager)* y usarlo directamente.

  
**INSERCIÓN**

Indicamos a Doctrine que queremos guardar un objeto en bbdd:

    $entityManager->persist($product)

Ejecutamos las sentencias sql correspondientes para que se inserte:

    $entityManager->flush();  

**ACTUALIZACIÓN**
  

- Creamos método para actualizar objeto
- Obtenemos datos de formulario
- Actualizamos bbdd (flush)

    

**BORRADO**
  

Creamos método para borrar el objeto, lo seleccionamos y finalmente lo eliminamos:

  

    /**
     * @Route("/notes/delete/{id}", name="note_delete")
     */
    public function delete(EntityManagerInterface $em, Note $note) {

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
  

**NOTA:** En el ejemplo anterior, obtenemos directamente el objeto añadiéndolo como parámetro e indicando en la ruta su ID (Esto también lo podemos hacer en la actualización). 


  



