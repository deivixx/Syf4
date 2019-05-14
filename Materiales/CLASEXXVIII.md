# DOCTRINE - RELACIONES ENTRE OBJETOS

## **DEFINICIÓN DE RELACIONES**

A la hora de crear una entidad, podemos establecer las relaciones existentes con otras entidades previamente creadas. Desde el comando **make:entity** , una vez definido un campo, se nos permite indicar el tipo de relación que representa como puede ser: ManyToOne, ManyToMany, OneToMany y OneToOne. 

Para que al insertar un elemento padre desde un formulario, los objetos hijo se inserten automáticamente, debemos añadir la opción *cascade={"persist"}* en la anotación que define la relación:

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteItem", mappedBy="note",cascade={"persist"})
     */
        private $noteItems;

 


## **FORMULARIOS PARA ENTIDADES RELACIONADAS**

Cuando definimos entidades que dependen unas de otras, como un pedido y líneas de pedido, deberíamos dar lo posibilidad de insertar ambas entidades en un mismo formulario, para esto se utiliza un formulario dentro de otro usando un campo del tipo *CollectionType*.

**DEFINICIÓN DEL FORMULARIO**

    ->add('title', TextType::class, ['label' => 'Título', 'help' => 'Escribe el título de la nota'])
    ->add('attachedFile', FileType::class, ['label' => 'Adjunto', 'required' => false])
    ->add('noteItems', CollectionType::class, [
	    'entry_type' => NoteItemType::class,
	    'allow_add' => true,
	    'allow_delete' => true,
	    'by_reference' => false,
	    'label' => false,    
    ])
    ->add('save', SubmitType::class, ['label' => 'Guardar Nota'])

- El ejemplo anterior representa un formulario que permite introducir objetos de tipo Note (una nota) y NoteItems (cada item de la nota)   
- Los dos primeros campos pertenecen a la entidad Note, el campo de tipo CollectionType representa a un conjunto indeterminado de formularios para la entidad relacionada, es decir, podremos insertar un item a la nota o varios, las opciones del tipo de campo son:

 
	-	**Allow_add** permite añadir subelementos y además genera un prototipo que contiene el HTML necesario para mostrar nuevos elementos NoteItem
	-	**Allow_delete** permite eliminar subelementos
	-	**By_reference** con valor false obliga a que se llame al setter

  

- En cada clase de formulario involucrada añadimos su clase en el **data_class** para indicar el objeto que albergará los datos del formulario:

	    public function configureOptions(OptionsResolver $resolver) {
    
		    $resolver->setDefaults([   
			    'data_class' => Note::class,    
		    ]);   
	    }


**JAVASCRIPT NECESARIO**  

Para que podamos añadir elementos de la entidad relacionada de forma dinámica en el formulario, necesitamos utilizar código javascript que al pulsar un botón inserte el HTML correspondiente al formulario de la entidad hija.
  
