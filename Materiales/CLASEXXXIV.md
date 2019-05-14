# TESTING


Cada test unitario o funcional debe ser una clase php dentro de la carpeta **tests**.

Para lanzar todos los tests ejecutamos el comando:

    php  bin/phpunit


## TESTS UNITARIOS

Cuando escribimos tests unitarios, por convención, debemos replicar la estructura de la aplicación. Por ejemplo, si queremos probar una clase que está en **src/Util/Lib.php** la clase test será **tests/Util/LibTest.php**.

Podemos limitar la ejecución a un directorio en concreto:

    php bin/phpunit tests/Util  

O a una clase en concreto:

    php bin/phpunit tests/Util/LibTest.php  

 
Si queremos acceder a bbdd dentro del test, podemos crear el objeto *manager* en el **setUp** del test y heredar de **KernelTestCase**:

    /**  
     * @var \Doctrine\ORM\EntityManager  
     */  
    private $manager;  
      
    /**  
     * {@inheritDoc}  
     */  
    protected function setUp()  
    {  
	    $kernel = self::bootKernel();  
	      
	    $this->manager = $kernel->getContainer()  
	    ->get('doctrine')  
	    ->getManager();  
    }

 
Para evitar problemas de memoria, cerramos manager en **tearDown()**:

    protected function tearDown() {
    
	    parent::tearDown();
	    $this->manager->close();    
	    $this->manager = null; // avoid memory leaks
    
    }

  

## TESTS FUNCIONALES

 
Cuando escribimos tests funcionales, podemos probar aspectos tales como:

-   Hacer una petición
    
-   Click en el submit de un formulario
    
-   Comprobar una respuesta
    

Estos tests funcionales vivirán dentro del directorio **tests/Controller** y deben heredar de **WebTestCase**.

Para facilitar el proceso de login en este tipo de tests, se puede habilitar la autenticación http en el fichero **config/packages/tests/security.yaml**:

    security:
    	firewalls:
    		main:
    			http_basic: true

Y autenticar en el test de la siguiente forma:

	$this->client = static::createClient([], [

		'PHP_AUTH_USER' => 'admin',

		'PHP_AUTH_PW' => 'admin',

	]);

El objeto cliente nos permite realizar peticiones y analizar las respuestas obtenidas:

    $this->client->request('GET', '/notes');

Si guardamos la petición en un “crawler”, podremos analizar los valores devueltos para hacer comprobaciones.

Comprobamos que el código HTTP devuelto es el 200:

    $crawler = $this->client->request('GET', '/notes');
    
    $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

Filtramos buscando un elemento h1, cogemos su texto y validamos su contenido:
  
    $this->assertSame('Login', $crawler->filter('h1')->text());


Si una página redirige a otra distinta, por defecto no se salta a ésta, para que esto suceda ejecutamos: 

    $this->client->followRedirect();

Podemos hacer click en enlaces a partir de su texto con: 

    $this->client->clickLink('Nueva Nota');

También podemos hacer submit de un formulario, indicando el texto que contiene el botón y añadiendo los valores de los campos:

    $crawler = $this->client->submitForm('Guardar Nota', [
    
	    'note[title]' => 'TEST',
    
    ]);



