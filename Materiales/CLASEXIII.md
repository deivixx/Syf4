**PLANTILLAS EN SYMFONY CON TWIG**

Las plantillas twig no procesan código PHP , tienen sus propias etiquetas, así evitamos mezclar lógica con presentación

**Twig** define tres tipos de sintaxis:

    {{ ... }} Dice algo

    {% ... %} Hace algo

    {# ... #} Comenta algo

También existen filtros que modifican el contenido de alguna forma:

    {{  title|upper  }}

Podemos ver un listado de filtros y funciones con:

    php bin/console debug:twig

**HERENCIA**    

  Twig permite mediante herencia, compartir elementos comunes en distintas páginas del proyecto para reutilizar código.
  

A partir de una plantilla base:

  

    <!DOCTYPE html>  
    <html>  
	    <head>  
		    <meta  charset="UTF-8">  
		    <title>{%  block  title  %}Test Application{%  endblock  %}</title>  
	    </head>  
	    <body>  
		    <div  id="sidebar">  
			    {%  block  sidebar  %}  
				    <ul>  
					    <li><a  href="/">Home</a></li>  
					    <li><a  href="/blog">Blog</a></li>  
				    </ul>  
			    {%  endblock  %}  
		    </div>  
		    <div  id="content">  
			    {%  block  body  %}{%  endblock  %}  
		    </div>  
	    </body>  
    </html>

En plantillas correspondientes a otros elementos del sitio, podríamos redefinir los bloques title, sidebar y content, por ejemplo:

    {# templates/blog/index.html.twig #}  
    {% extends 'base.html.twig' %}  
      
    {% block title %}My cool blog posts{% endblock %}  
      
    {% block body %}  
	    {% for entry in blog_entries %}  
		    <h2>{{ entry.title }}</h2>  
		    <p>{{ entry.body }}</p>  
	    {% endfor %}  
    {% endblock %}

  
  


-   Cuantas más etiquetas  {% block %} haya en la plantilla base más podremos reutilizar código. Las plantillas hijas no tienen que redefinir todos los bloques de la plantilla padre.

-   Si ves que necesitas repetir código en distintas plantillas, probablemente podrías solucinarlo moviendo ese código dentro de un  {% block %} en una plantilla padre. En algunos casos, la mejor solución puede ser mover el contenido a una plantulla a parte e incluirla.

-   Si necesitas obtener contenido de un bloque de la plantilla padre, puedes usar la función {{ parent() }} 

  