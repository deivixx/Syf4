**TWIG - ACCESO A USER, REQUEST, COOKIES ...**

Representa al usuario actual si lo hay

`app.user`

Representa la request  actual

`app.request`

Representa la sesión actual del usuario o null si no existe

`app.session`


	<p>Username: {{ app.user.username }}</p>
	{% if app.debug %}
	    <p>Request method: {{ app.request.method }}</p>
	    <p>Application Environment: {{ app.environment }}</p>
	{% endif %}