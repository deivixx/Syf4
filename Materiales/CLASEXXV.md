## ENTIDADES CON DOCTRINE

 
Una vez tenemos **Symfony** configurado para acceder a una base de datos, podemos proceder a crear las entidades que sean necesarias, al crear una entidad, podremos crear una tabla en la base de datos, una clase que mapea esta entidad y un repositorio asociado.

Para crear una entidad, ejecutamos el siguiente comando:

	php bin/console make:entity

Se nos mostrará un menú interactivo que nos permitirá crear la entidad y todos sus campos, así como las relaciones con otras entidades.

Si en el nombre de la entidad escribimos **Note** , se crearán los ficheros

- Entity\Note.php

- Repository\NoteRepository.php

Una vez creada la entidad, tendremos que guardar los cambios en la base de datos, es decir, crear las tablas correspondientes:

	php bin/console make:migration

Esto genera un fichero con todo el **sql** necesario para crear la tabla correspondiente

- Ejecutamos los ficheros sql:

		php bin/console doctrine:migrations:migrate