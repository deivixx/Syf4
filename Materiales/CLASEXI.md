**OBJETOS REQUEST Y RESPONSE**

La clase **Request** nos permite acceder a información que en una aplicación web tradicional accederíamos usando $_GET, $_POST o $_COOKIE

Ejemplos:

- Equivale a **$_GET['v1']**

	  $v1 = $request->get('v1');

- Equivale a **$_GET['v1']**

	  $v1 = $request->query->get('v1');

- Equivale a **$_POST['v2']**

	  $v2 = $request->request->get('v2');

- Equivale a **$_COOKIE['user']**

	  $user = $request->cookies->get('user');
   
La clase **Response** , nos permite establecer valores en las cabeceras antes de enviar la respuesta al cliente:

    $response = new Response();
    $response->headers->setCookie(new Cookie('user', 'david'));
    $response->setContent($v1." ".$v2." ".$user);     
    $response->headers->set('Content-Type', 'text/html'); 

También podemos devolver una respuesta en fomato **JSON:**

    $response = JsonResponse::fromJsonString('{ "data": 123 }');
    return $response;


A través del helper **file** , podemos retornar un fichero desde el controlador al cliente:

    $file = new File('file.pdf');
    // Descarga fichero
    return $this->file($file);
    // Abre fichero en navegador
    return $this->file($file, 'my_file.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
