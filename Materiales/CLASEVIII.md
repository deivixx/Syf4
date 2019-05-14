**CONTROLADORES EN SYMFONY**

- Usamos el namespace App\Controller donde estarán todos los controladores
- Añadimos la sentencia use antes de la clase que queremos importar, por ejemplo la clase Response para generar respuestas HTTP
- Creamos clase cuyo prefijo, por convenio suele ser Controller
- Extendemos de la clase AbstractController para tener acceso a distintos helpers como los necesarios para renderizar una plantilla

	    namespace App\Controller;
    
	    use Symfony\Component\HttpFoundation\Response;
	    use Symfony\Component\Routing\Annotation\Route;
	    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController
    
	    class LuckyController extends AbstractController
	    {
	        /**
		     * @Route("/lucky/number/{max}", name="app_lucky_number")
		     */
	        public function number($max)
	        {
	            $number = random_int(0, $max);
    
	            return new Response(
	                '<html><body>Lucky number: '.$number.'</body></html>'
	            );
	        }
	    }
