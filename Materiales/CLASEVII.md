**RUTAS CON PARÁMETROS**

    /**
     * @Route("/newresponse/{name}", name="new_response", requirements={"name"="[a-z]+"})
     */
        public function newResponse($name = null) {
            return new Response("<html><body><h1>Hola $name desde OpenWebinars</h1></body></html>");
        }


**GENERACIÓN DE RUTAS**

Podemos generar URL's dentro de un controlador de varias formas:

- A partir del nombre de la ruta:
  

      $url = $this->generateUrl(
                        'new_url'
                );

- Usando parámetros: 
   

	  $urlParametros = $this->generateUrl(
               'new_response', array('name' => 'david')
       );

- Estableciendo el **locale**:

	  $urlLocalizada = $router->generate('new_nota', array(
           '_locale' => 'es',
       ));

- Creando URL absoluta:

      $urlAbsoluta = $this->generateUrl('new_response', array('name' => 'david'), UrlGeneratorInterface::ABSOLUTE_URL);



