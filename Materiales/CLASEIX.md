**REDIRECCIÓN EN UN CONTROLADOR**

- A partir de nombre de ruta

	  return $this->redirectToRoute('new_url');

- Nombre de ruta con parámetros

	  return $this->redirectToRoute('new_nota',array('nota'=>10));          

- URL externa

	  return $this->redirect('http://www.google.com');
