# AUTENTICACIÓN Y FIREWALLS


**FORMULARIO DE LOGIN**

Vamos a crear un formulario de login mediante la consola de comandos:

    php bin/console make:auth  

![](https://lh3.googleusercontent.com/tA8OacuPlpM8Vh6E5RJQ7rbkI2NnQptkiFc7Ml3eDR7XGdUwKCyFTwMICqBnN3YAqyvVDlzy5ocB9GTKz0l_dLt4vITtLdaRNWeryfdp5krKIXpJ2Lzo6nY1XKYM5KsTBkc4GlAT)

 
Este comando realiza las siguientes acciones:

1.  Controlador y ruta para login *(src/Controller/SecurityController.php)*
    
2.  Plantilla que renderiza formulario de login *(templates/security/login.html.twig)*
    
3.  Clase que procesa el submit del formulario de login *(src/Security/LoginFormAuthenticator.php)*
    
4.  Actualiza el fichero **security.yaml**
    

Podemos modificar la plantilla generada para adaptar el estilo del formularioa nuestro gusto.

Para que se redireccione una vez hecho el login, debemos añadir un **redirect** en el método **LoginFormAuthenticator** en la sección *TODO*:

    return new RedirectResponse($this->router->generate('note_index'));

  
**FIREWALLS**  
  
La sección más importante del fichero **security.yaml** es la de **firewalls**, donde se define cómo se autenticarán los usuarios *(login form, API token ...)*

Para añadir la función de logout , modificamos el firewall **main** del fichero security.yaml añadiendo:

    firewalls:
            dev:
                pattern: ^/(_(profiler|wdt)|css|images|js)/
                security: false
            main:
                anonymous: true
                guard:
                    authenticators:
                        - App\Security\LoginFormAuthenticator
                logout:
                    path: app_logout
                    target: app_login

  
A continuación, modificamos el fichero de configuración **routes.yaml** para añadir la ruta:

    app_logout:  
    	path: /logout  
    	methods: GET

    
**FORMULARIO DE REGISTRO**
  
Un formulario de registro, facilita la creación de usuarios, Symfony provee un mecanismo de creación de este formulario por medio de la consola de comandos:


    php bin/console make:registration-form  

 
*Esto crea un controlador para el registro, la plantilla asociada y una clase de formulario*

**ACCESO AL USUARIO DESDE PLANTILLA**  
  
  Seguramente , nuestra aplicación tendrá un comportamiento diferente en función de si el usuario está o no autenticado, podemos saber si un usuario está autenticado desde una plantilla con:
  

    {% if is_granted('IS_AUTHENTICATED_FULLY') %}

Por otro lado, una vez que sabemos que el usuario está autenticado, podemos acceder a sus datos con **app.user**:

    {{ app.user.username }}
