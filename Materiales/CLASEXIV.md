**ETIQUETAS TWIG**

* filter

	  {%  filter upper %}  
	    This text becomes uppercase  
	  {%  endfilter  %}

  
 * Set

	   {% set foo = 'bar' %}

  

* For

	- A partir de una variable **users** que contiene un listado de usuarios:
	
			<h1>Members</h1>
		        <ul>
		          {% for user in users %}
		    	     <li>{{ user.username|e }}</li>
		          {% endfor %}
		        </ul>

  - Iteramos sobre una secuencia

		 {% for i in 0..10 %}
		     * {{ i }}
		 {% endfor %}

   - Igual pero mostrando el índice (comienza en 1)

		  {% for user in users %}
		      {{ loop.index }} - {{ user.username }}
		  {% endfor %}

	- Si no hay elementos se muestra el bloque **else**

		    <ul>
			      {% for user in users %}
					     <li>{{ user.username|e }}</li>
				    {% else %}
					     <li><em>no user found</em></li>
			      {% endfor %}
		    </ul>

  
- If

	    {% if online == false %}
		     <p>Our website is in maintenance mode. </p>
	    {% endif %}



	    {% if temperature > 18 and temperature < 27 %}
		     <p>It's a nice day for a walk in the park.</p>
	    {% endif %}


	    {% if product.stock > 10 %}
		     Available
	    {% elseif product.stock > 0 %}
		     Only {{ product.stock }} left!
	    {% else %}
		     Sold-out!
	    {% endif %}




**FILTROS TWIG**
  

- batch

	- Hace grupos de 3 y completa los grupos con menos elementos

		    {% set items = ['a', 'b', 'c', 'd', 'e', 'f', 'g'] %}
    
		    <table>
			    {% for row in items|batch(3, 'No item') %}
				     <tr>
					      {% for column in row %}
						     <td>{{ column }}</td>
					      {% endfor %}
				   </tr>
				  {% endfor %}
			</table>

- capitalize: Pone primera letra en mayúscula

	  {{ 'my first car'|capitalize }}

- date: Da formato de fecha

	    {{ post.published_at|date("m/d/Y") }}
	    {{ "now"|date("m/d/Y") }}

- first, last: Devuelve primer/último elemento de una secuencia, array o cadena

	    {{ [1, 2, 3, 4]|first }}
    
	    {{ '1234'|last }}

- join: Une elementos de un array 

	   {{ [1, 2, 3]|join }}

- length: Devuelve tamaño de un array
- round: Redondea un valor numérico 
- sort: Ordena un array por órden alfabético
- raw: Muestra el contenido de una variable sin escapar
- dump: Esta función muestra el valor de las variables a las que tiene acceso la plantilla

	   {{ dump() }}


