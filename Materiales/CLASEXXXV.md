# API REST - CONFIGURACIÓN

## INSTALACIÓN BUNDLE

Para empezar a crear un API REST en nuestro proyecto a partir de las entidades existentes, instalamos mediante composer el conjunto de paquetes necesarios con:

    composer req api

Una vez finalizada la instalación, podemos acceder a la URL  **/api**  de nuestra aplicación, ahí podemos ver un página donde deberían aparecer todos nuestros **endpoints** e incluso hacer pruebas con ellos, de momento no hemos definido ninguno, por tanto aparece vacío.


##   CONFIGURACIÓN

El siguiente paso es definir la entidad que va a formar parte del api, para esto añadimos la anotación **@ApiResource**  en la entidad correspondiente y de esta forma se definirán automáticamente los **endpoint** para todas las operaciones que se pueden hacer con la entidad *(GET, POST, PUT y DELETE)*

    /**
     * @ApiResource
     */
    class Note
    {    .... 

 
Si ahora accedemos a **/api** veremos el listado con todos los endpoint creados asociados a la entidad.

**OPERACIONES**

Si queremos limitar las operaciones disponibles para la entidad, lo haremos mediante la anotación, indicando las operaciones a nivel de colección e individuales:

    * @ApiResource(  
	*   collectionOperations={"get"={"method"="GET"}},  
    *   itemOperations={"get"={"method"="GET"}}  
    * )

Podemos modificar otros aspectos, como la ruta, valores por defecto, validaciones …

    * @ApiResource(itemOperations={  
    *   "get"={"method"="GET", "path"="/testnote/{id}", "requirements"={"id"="\d+"}, "defaults"={"title"="Test title"} },  
    *   "put"={"method"="PUT", "path"="/note/{id}/update"
    * })


**PREFIJO ENDPOINT**

Mediante el atributo routePrefix, podemos añadir un prefijo a todos los métodos, es decir, si por defecto el endpoint es **/api/notes**, con el prefix **/v1** sería **/api/v1/notes**

  

    * @ApiResource(routePrefix="/v1")

