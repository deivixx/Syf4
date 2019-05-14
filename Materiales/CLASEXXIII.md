## SUBIDA DE FICHEROS

Para subir ficheros asociados a una clase desde un formulario seguiremos los siguientes pasos:

1.  Creamos campo de tipo string en la clase destino *(podemos añadir validación de tipo)*:

	    /**
	     * @ORM\Column(type="string")
	     *
	     * @Assert\NotBlank(message="Please, upload the product brochure 	as a PDF file.")
	     * @Assert\File(mimeTypes={ "application/pdf" })
	     */
	      private $brochure;
    
2.  Añadimos campo en clase formulario:

        ->add('brochure', FileType::class, ['label' => 'Brochure (PDF file)'])
    
3.  Añadimos código en controlador
    
	    if ($form->isSubmitted() && $form->isValid()) {
    	   //Obtenemos fichero
    	   $file = $product->getBrochure();
    
	       // Creamos nombre único con md5
    	   $fileName = md5(uniqid()).'.'.$file->guessExtension();
    
           // Se mueve fichero a directorio establecido
           try {
                $file->move(
                   $this->getParameter('brochures_directory'),
                   $fileName
                );
            } catch (FileException $e) {
                 // ... manejamos excepciones
            }
    
            // Actualizamos objeto con el nombre de fichero
            $product->setBrochure($fileName);
    
            // ... persistimos el objeto

 
**NOTA:**   En el ejemplo, 'brochures_directory' hace referencia al directorio donde se guardarán los ficheros, este directorio se configura en el fichero *services.yaml*

    parameters:    
    locale: 'en'
    attached_directory: '%kernel.project_dir%/public/uploads/attached'
    
      

      
**COMPORTAMIENTO INPUT**

Por defecto, el input asociado al fichero, no muestra el nombre del fichero seleccionado, para que esto no ocurra hay que añadir el siguiente código js modificando el id del input:

    $('.custom-file-input').on('change',function(){
    
	    var fileName = document.getElementById("note_attachedFile").files[0].name;
    
	    $(this).next('.custom-file-label').addClass("selected").html(fileName);
	})
