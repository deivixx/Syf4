**CREACIÓN DE FORMULARIOS**

Podemos crear un formulario por código dentro de un controlador para almacenar información de un objeto. A partir de una clase Note:

    public function new(Request $request)
    {
        // Creamos objeto Note
        $note = new Note();
        $form = $this->createFormBuilder($note)
                ->add('title', TextType::class,  ['label' => 'Título'])
                ->add('note', TextType::class,  ['label' => 'Nota'])
                ->add('dueDate', DateType::class, ['label' => 'Fecha vencimiento'])
                ->add('save', SubmitType::class, ['label' => 'Guardar Nota'])
                ->getForm();
    
            
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

  

***Renderizado***
  
La forma más básica para renderizar un formulario es indicar que se muestre el formulario completo:

    {{ form(form) }}


Symfony viene con una serie de temas de formulario que podemos usar:

-   form_div_layout.html.twig    
-   form_table_layout.html.twig
-   bootstrap_3_layout.html.twig
-   bootstrap_3_horizontal_layout.html.twig
-   bootstrap_4_layout.html.twig
-   bootstrap_4_horizontal_layout.html.twig
-   foundation_5_layout.html.twig


Por ejemplo, para cambiar el tema del formulario, antes de su renderizado escribimos:

    {% form_theme form 'form_table_layout.html.twig' %}

  
  
  
  
