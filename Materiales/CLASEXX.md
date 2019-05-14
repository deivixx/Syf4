**VALIDACIÓN DE FORMULARIOS**

Cuando creamos un formulario que está asociado a una clase, si añadimos una serie de ***asserts*** , en los campos de la clase, el formulario los tendrá en cuenta a la hora de realizar las validaciones pertinentes para que los valores cumplan los requisitos establecidos.

La validación de campos, la haremos mediante anotaciones, por ejemplo:

- El campo no puede estar vacío y debe tener longitud de 3 mínimo

	   /**
	    * @Assert\NotBlank
	    * @Assert\Length(min=3)
	    */
	    public $name;

- Se valida que el campo sea del tipo especificado *(DateTime)*

	   /**
	    * @Assert\Type("\DateTime")
	    */
	    public $date;


- Podemos definir rango de longitud y mensajes de error específicos

	   /**
	    * @Assert\NotBlank
	    * @Assert\Length(max=255, maxMessage="Nota demasiado larga", min=4, minMessage="Nota demasiado corta")
	    */
	    public $note;



Por defecto, cuando ocurre un error de validación en un formulario, éste se muestra en el campo en cuestión; al definir los campos de un formulario, podemos indicar que el error se muestre asociado al formulario en lugar de al campo, para esto usamos la opción **error_bubbling** con valor **true**:

    ->add('note', TextType::class,  ['label' => 'Nota','error_bubbling'=> true])
