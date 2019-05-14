## ENTIDAD PARA AUTENTICACIÓN DE USUARIOS

Para que los usuarios puedan autenticarse en la aplicación, deben estar almacenados en una tabla y tener una entidad asociada, Symfony permite crear una entidad User para este cometido.

Creamos entidad y elegimos las opciones que mejor se adapten a nuestras necesidades:

    php bin/console make:user  

	The name of the security user class (e.g. User) [User]:  
	> User  
	Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:  
	> yes  
	Enter a property name that will be the unique "display" 		name for the user (e.g.  
	email, username, uuid [email]  
	> email  
	Does this app need to hash/check user passwords? (yes/no) 	[yes]:  
	> yes

  

* Si necesitamos más campos en la entidad, podemos añadirlos con el comando make:entity

* Si nuestra aplicación requiere password podemos controlar la codificación de éste mediante el fichero security.yaml, en nuestro caso el algoritmo usado es **argon2i**

  