## DOCTRINE - SELECCIÓN DE OBJETOS  

Para probar la selección de objetos con Doctrine, es decir, consultar los registros de una tabla, necesitamos que esta tabla contenga información, una forma de resolver esto es accediendo con PhpMyAdmin e introducir algunos datos desd el navegador.

1.  Creamos un controlador para nuestra entidad y la plantilla **index** para el listado:
   

	    php bin/console make:controller NoteController  
  
2.  Para comprobar que los datos están correctamente y que hay conexión con la bbdd ejecutamos una consulta desde consola:
   

	    php bin/console doctrine:query:sql "SELECT * FROM note"

  
3.  Ahora vamos a seleccionar **notas** de bbdd directamente, para esto, haremos uso del repositorio: 

	    $repository  =  $this->getDoctrine()->getRepository(Product::class);
    
	El cual nos permite ejecutar métodos sobre él como:

	    $repository->findAll()
    
	    $repository->find($id)
    
	    $repository->findOneBy([‘title’=>’Compra’])
    
	    $repository->findBy[NombreCampo](valor)

  


Cada vez que doctrine accede a base de datos y ejecuta alguna sentencia SQL, podemos ver exactamente lo que se ha ejecutado desde el **Profiler**.
    
Además de los distintos métodos de consulta que hemos visto usando el repositorio,  podemos usar nuestros métodos personalizados en el repositorio con *querybuilder*:

  

    public function findLikeTitle($val) {

        $qb = $this->createQueryBuilder('n');
        return $this->createQueryBuilder('n')
                        ->Where($qb->expr()->like('n.title', ':val'))
                        ->setParameter('val', "%$val%")
                        ->getQuery()
                        ->getResult()
        ;
    }  
  

6. Además de poder usar sintaxis DQL y SQL

  
	public function findDQL($note) {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
                        'SELECT n
        FROM App\Entity\Note n
        WHERE n.note like :note
        ORDER BY n.title ASC'
                )->setParameter('note', "%$note%");

        return $query->execute();
    }

    public function findSQL($note) {
        
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM note n
                WHERE n.note like :note
            ORDER BY n.title ASC';
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['note' => "%$note%"]);

        
        return $stmt->fetchAll();
    }



