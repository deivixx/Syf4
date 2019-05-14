## DATA FIXTURES

Symfony provee un método para disponer de datos de forma sencilla en base de datos, estos datos, son útiles para hacer pruebas o simplemente para poder comenzar a utilizar una aplicación, ya sea un listado de provincias, productos, usuario administrador etc.

**INSTALACIÓN Y CREACIÓN**  

Este comando nos permite comenzar a utilizar los Data Fixtures de Symfony:

    composer require orm-fixtures --dev

Este comando nos crea una clase fixture vacía, en la cual dispondremos de un método **load** para cargar los datos:

    php bin/console make:fixtures  

Dentro del método load, añadimos el código necesario para crear nuevos objetos:

	public function load(ObjectManager $manager) {

        for ($i = 0; $i < 5; $i++) {
            $note = new Note();
            $note->setTitle($i);

            $date = new \DateTime();
            $item1 = new NoteItem();
            $item1->setText("Lorem ipsum dolor sit amet consectetur adipiscing ");
            $item1->setDueDate($date->modify('+1 day'));
            $note->addNoteItem($item1);

        }

        $manager->flush();
    }

Finalmente cargamos datos en bbdd con :

    php bin/console doctrine:fixtures:load  

  
