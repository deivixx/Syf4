# ENVÍO DE EMAIL

Para configurar el envío de email, tendremos que editar el fichero **.env** y establecer la url del servidor **smtp** en la opción **MAILER_URL**.                                                                                                                                                                                       
  

**GMAIL:** 

    gmail://username:password@localhost

**SMTP GENÉRICO:**

    smtp://localhost:25?encryption=&auth_mode=

**ENVÍO DESHABILITADO:**

    null://localhost

  
Para enviar un mail debemos usar el servicio **Swift_Mailer**, al cual podemos acceder de forma sencilla gracias a la inyección de dependencias.

El envío consiste en crear un **Swift_Message**, al cual se le asignan atributos como remitente, destinatario y cuerpo del mensaje.

  

    $message = (new \Swift_Message('Hello Email'))  
	    ->setFrom('send@example.com')  
	    ->setTo('recipient@example.com')  
	    ->setBody(  
		    $this->renderView(  
		    // templates/emails/registration.html.twig  
		    'emails/registration.html.twig',  
		    ['name' => $name]  
		    ),  
		    'text/html'  
	    );

Y finalmente se envía con: 

    $mailer->send($message);  

  
El cuerpo del mensaje, puede ser texto plano **->setBody(“hola”)** o se puede obtener renderizando una plantilla twig, de esta forma se pueden crear plantillas para el envío de correos en cualquier formato

Durante el desarrollo, puede ser útil deshabilitar temporalmente el envío de correos para no inundar de correos a las cuentas que se utilicen de prueba, para esto, en el fichero de configuración **swiftmailer.yaml** :

    swiftmailer:
    	disable_delivery: true

Si no queremos deshabilitar el envío, porque realmente necesitamos probar que se envían correctamente, podemos establecer una única cuenta de destino para todos los envíos, lo cual facilita la comprobación y evita el envío de correos no deseados a cuentas reales:

    swiftmailer:  
    	delivery_addresses: ['dev@example.com']
