**PÁGINAS DE ERROR PERSONALIZADAS**

Podemos hacer que nuestra aplicación web, muestre mensajes de error de forma personalizada siguiendo el estilo de la aplicación y evitando que se muestre información sensible en el error.

Debemos crear las plantillas correspondientes en **templates\bundles\TwigBundle\Exception** , por ejemplo, esta podría ser una estructura para distintos códigos de error:

    templates/
    └─ bundles/
       └─ TwigBundle/
          └─ Exception/
             ├─ error404.html.twig
             ├─ error403.html.twig
             ├─ error.html.twig      # All other HTML errors (including 500)
             ├─ error404.json.twig
             ├─ error403.json.twig
             └─ error.json.twig      # All other JSON errors (including 500


**PROBAR PÁGINAS DE ERROR EN DESARROLLO**

Si queremos ver el resultado de nuestra página de error personalizada, podemos acceder a una URL especial para ello, por ejemplo, si queremos ver la página de error para el código 404, accederíamos a:

    http://localhost:8000/index.php/_error/404.html

Si queremos ver el mismo error pero para el formato JSON:

    http://localhost:8000/index.php/_error/404.json
