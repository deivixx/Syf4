**SESIONES EN SYMFONY**

Symfony provee un servicio que permite almacenar información en sesión. El funcionamiento de la sesión se puede configurar a través del fichero `config/packages/framework.yaml` , por ejemplo, en este fichero podemos establecer el tiempo máximo de la sesión con el parámetro en segundos `cookie_lifetime:`

	public function testSession(SessionInterface $session){    
        
        if(is_null($session->get('name'))){
            $session->set('name', 'david');
        }
           
        return new Response("Valor guardado en sesión");
    } 

**MENSAJES FLASH**

Una característica interesante que ofrece Symfony es la posibilidad de almacenar mensajes en sesión a modo de información, advertencia o error. Estos mensajes se borran una vez han sido vistos por el usuario.

    $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

En la plantilla accedemos a ellos:

    {% for message in app.flashes('notice') %}
        <div class="flash-notice">
            {{ message }}
        </div>
    {% endfor %}
