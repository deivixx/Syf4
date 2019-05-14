# ROLES Y CONTROL DE ACCESO


## **ROLES**

Symfony nos permite definir ROLES según nuestras necesidades, de esta forma al asignar estos roles a los usuarios podemos restringir de forma sencilla las acciones que pueden llevar a cabo o las páginas que pueden visitar. 

Cuando un usuario hace login, se hace un **getRoles()** para obtener los roles asociados del usuario, por defecto cada usuario tiene el rol **ROLE_USER**.

Podemos definir una jerarquia de roles en security.yaml
    
    role_hierarchy:  
    	ROLE_ADMIN: ROLE_USER  
        ROLE_SUPER_ADMIN:  [ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH]


## **CONTROL DE ACCESO**


**MÉTODOS**

El control de acceso nos permite, por ejemplo, que un método no sea ejecutado si el usuario no está autenticado, para lo cual, dentro del método, insertaríamos el código:

    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');  

También podemos limitar un método a un ROL en concreto usando anotaciones:

    @IsGranted("ROLE_USER")


Dentro del método, podemos tener acceso al usuario con: 

    $user  =  $this->getUser();  


**URL's**

En el fichero de configuración **security.yaml**, en la sección **access_control**, podemos definir qué roles son necesarios para acceder a según qué URL's:
   
    access_control:
             - { path: ^/admin, roles: ROLE_ADMIN }
             - { path: ^/notes, roles: ROLE_USER }


**VOTERS**

Podemos definir nuestra propia lógica para decidir qué acciones pueden hacer los usuarios mediante **Voters**, una clase Voter, recibe una acción y el objeto sobre el que recae esa acción.

1. Debe decidir en primer lugar si va a votar o no *supports($attribute, $subject)* , devolviendo true o false.
 
2. Si es **true** , en función de la acción, se llamará a un método u otro *(canEdit, canDelete ...)* . 

4. En el controlador comprobaremos los permisos, por ejemplo, con :
   

	    $this->denyAccessUnlessGranted('delete', $note);

  
	  Donde se validaría si el usuario tiene el permiso 'delete' sobre el objeto $note.